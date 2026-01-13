<?php

namespace App\Http\Controllers\Dropshipper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Transaction;

class OrderController extends Controller
{
    // === 1. TAMPILAN STANDAR (JANGAN DIUBAH) ===
    public function index() {
        $orders = Order::where('user_id', Auth::id())->where('status', '!=', 'completed')->latest()->get();
        // Hitung manual badge
        $counts = [
            'pending' => $orders->where('payment_status','pending')->count(),
            'processing' => $orders->where('status', 'processing')->count(),
            'shipping' => $orders->where('status', 'shipping')->count(),
            'completed' => Order::where('user_id', Auth::id())->where('status', 'completed')->count(),
        ];
        return view('dropshipper.orders', compact('orders', 'counts'));
    }

    public function orderHistory() {
        $orders = Order::where('user_id', Auth::id())
            ->with('items')
            ->latest()
            ->get();
            
        // Hitung statistik
        $totalOrders = $orders->count();
        $totalSpend = $orders->sum('grand_total');
        $itemsBought = $orders->sum(function($order) {
            return $order->items->sum('quantity');
        });
        
        $stats = [
            'total_orders' => $totalOrders,
            'total_spend' => $totalSpend,
            'items_bought' => $itemsBought
        ];
        
        return view('dropshipper.order-history', compact('orders', 'stats'));
    }

    public function orderShow($id) {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        return view('shared.order-show', compact('order'));
    }

    public function cart() {
        $cart = Session::get('cart', []);
        return view('dropshipper.cart', compact('cart'));
    }

    // === 2. LOGIC KERANJANG (ADD, UPDATE, REMOVE) ===
    public function addToCart(Request $request) {
        $productId = $request->input('product_id'); 
        $quantity = $request->input('quantity', 1);
        $product = Product::findOrFail($productId);
        $cart = Session::get('cart', []);

        if(isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image_url,
                "supplier_id" => $product->user_id
            ];
        }
        Session::put('cart', $cart);
        return redirect()->route('dropshipper.cart')->with('success', 'Masuk keranjang!');
    }

    public function updateCart(Request $request) {
        if($request->id && $request->quantity){
            $cart = Session::get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            Session::put('cart', $cart);
            return redirect()->back();
        }
    }

    public function removeFromCart(Request $request) {
        if($request->id) {
            $cart = Session::get('cart');
            unset($cart[$request->id]);
            Session::put('cart', $cart);
            return redirect()->back();
        }
    }

    // === 3. CHECKOUT PAGE (TAMPILAN BAYAR) ===
    public function checkoutPage(Request $request)
    {
        if (!$request->has('selected_items') || empty($request->selected_items)) {
            return redirect()->route('dropshipper.cart')->with('error', 'Pilih produk dulu!');
        }

        $cart = Session::get('cart');
        $selectedIds = $request->selected_items;
        $selectedProducts = [];
        $totalHarga = 0;

        foreach($selectedIds as $id) {
            if(isset($cart[$id])) {
                $cart[$id]['id'] = $id; 
                $selectedProducts[] = $cart[$id];
                $totalHarga += $cart[$id]['price'] * $cart[$id]['quantity'];
            }
        }

        return view('dropshipper.payments', compact('selectedProducts', 'totalHarga'));
    }

    // === 4. PROSES BAYAR "ANTI GAGAL" ===
    public function processPayment(Request $request)
    {
        // Enable query logging for debugging
        \DB::enableQueryLog();
        
        try {
            // Validasi alamat pengiriman
            $validated = $request->validate([
                'shipping_name' => 'required|string|max:255',
                'shipping_phone' => 'required|string|max:20',
                'shipping_address' => 'required|string',
                'shipping_city' => 'required|string|max:100',
                'shipping_postal_code' => 'required|string|max:10',
                'shipping_cost' => 'required|numeric|min:0',
                'platform_fee' => 'required|numeric|min:0',
                'grand_total' => 'required|numeric|min:0',
                'selected_ids' => 'required|string',
                'payment_method' => 'nullable|string|max:50',
                'proof_of_payment' => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
            ]);

            $cart = Session::get('cart', []);
            if(empty($cart) || empty($validated['selected_ids'])) {
                return redirect()->back()->with('error', 'Keranjang kosong atau produk tidak dipilih');
            }

            $selectedIds = explode(',', $validated['selected_ids']);
            
            // Hitung total harga produk
            $productTotal = 0;
            $orderItems = [];
            
            foreach($selectedIds as $id) {
                if(isset($cart[$id])) {
                    $productTotal += $cart[$id]['price'] * $cart[$id]['quantity'];
                    
                    // Prepare order items data
                    $orderItems[] = [
                        'product_id' => $id,
                        'quantity' => $cart[$id]['quantity'],
                        'price' => $cart[$id]['price'],
                        'subtotal' => $cart[$id]['price'] * $cart[$id]['quantity'],
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
            }
            
            if (empty($orderItems)) {
                return redirect()->back()->with('error', 'Tidak ada item yang valid dalam keranjang');
            }
            
            // Hitung grand total
            $grandTotal = $productTotal + $validated['shipping_cost'] + $validated['platform_fee'];

            // Upload bukti pembayaran
            $proofPath = 'payments/bukti-otomatis.jpg';
            if ($request->hasFile('proof_of_payment')) {
                try {
                    $proofPath = $request->file('proof_of_payment')->store('payments', 'public');
                } catch (\Exception $e) {
                    \Log::error('Error uploading payment proof: ' . $e->getMessage());
                    return redirect()->back()->with('error', 'Gagal mengunggah bukti pembayaran: ' . $e->getMessage());
                }
            }

            DB::beginTransaction();
            
            try {
                // Buat Order dengan data lengkap
                $orderData = [
                    'user_id' => Auth::id(),
                    'order_code' => 'ORD-' . now()->format('Ymd') . '-' . strtoupper(\Str::random(6)),
                    'total' => $productTotal,
                    'status' => 'processing',
                    'payment_status' => 'paid',
                    'payment_method' => $validated['payment_method'] ?? 'Transfer Manual',
                    'payment_proof' => $proofPath,
                    'margin' => 0,
                    'shipping_name' => $validated['shipping_name'],
                    'shipping_phone' => $validated['shipping_phone'],
                    'shipping_address' => $validated['shipping_address'],
                    'shipping_city' => $validated['shipping_city'],
                    'shipping_postal_code' => $validated['shipping_postal_code'],
                    'shipping_cost' => $validated['shipping_cost'],
                    'platform_fee' => $validated['platform_fee'],
                    'grand_total' => $grandTotal,
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                // Debug: Log the order data
                \Log::info('Creating order with data:', $orderData);
                
                // Create the order
                $order = Order::create($orderData);
                
                if (!$order) {
                    throw new \Exception('Gagal membuat pesanan');
                }
                
                // Debug: Log the created order
                \Log::info('Order created:', ['order_id' => $order->id]);

                // Add order_id to order items
                foreach ($orderItems as &$item) {
                    $item['order_id'] = $order->id;
                }
                
                // Insert all order items at once
                $result = \DB::table('order_items')->insert($orderItems);
                
                if (!$result) {
                    throw new \Exception('Gagal menambahkan item pesanan');
                }
                
                // Hapus item dari session cart
                foreach($selectedIds as $id) {
                    if(isset($cart[$id])) {
                        unset($cart[$id]);
                    }
                }
                
                // Update cart session
                Session::put('cart', $cart);
                
                // Commit the transaction
                DB::commit();
                
                // Debug: Log success
                \Log::info('Order processed successfully', ['order_id' => $order->id]);
                
                // Redirect ke halaman riwayat pesanan
                return redirect()->route('dropshipper.order.history')
                    ->with('success', 'Pesanan berhasil dibuat dan sedang diproses!');

            } catch (\Exception $e) {
                DB::rollBack();
                \Log::error('Error processing order: ' . $e->getMessage());
                \Log::error('Stack trace: ' . $e->getTraceAsString());
                \Log::error('Last query: ' . \DB::getQueryLog()[count(\DB::getQueryLog())-1]['query']);
                
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi. ' . $e->getMessage());
            }
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
                
        } catch (\Exception $e) {
            \Log::error('Unexpected error in processPayment: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan tidak terduga. Silakan coba lagi. ' . $e->getMessage());
        }
    }
    public function confirmPayment($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Validasi hanya bisa konfirmasi jika masih pending
        if ($order->payment_status !== 'paid') {
            return back()->with('error', 'Pembayaran sudah dikonfirmasi.');
        }

        DB::beginTransaction();
        try {
            // 1. Update status pembayaran
            $order->update([
                'payment_status' => 'paid',
                'status' => 'processing'
            ]);

            // 2. (OPSIONAL TAPI DISARANKAN) Simpan ke tabel transaksi
            Transaction::create([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'amount' => $order->grand_total,
                'status' => 'success',
                'created_at' => now()
            ]);

            DB::commit();
            return redirect()->route('dropshipper.order')
                ->with('success', 'Pembayaran berhasil dikonfirmasi');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal konfirmasi pembayaran');
        }
    }
}