<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

class PesananController extends Controller
{
    // === 1. HALAMAN ORDER MASUK ===
    public function orderMasuk()
    {
        $supplierId = Auth::id();

        // CARI ORDER YANG MENGANDUNG PRODUK MILIK SUPPLIER INI
        $orders = Order::whereHas('items.product', function($query) use ($supplierId) {
            $query->where('user_id', $supplierId);
        })
        ->where('payment_status', 'paid') // Hanya yang sudah dibayar
        ->where('status', 'processing')   // Hanya yang statusnya 'Perlu Dikemas'
        ->with(['user', 'items' => function($query) use ($supplierId) {
            // Eager load items, tapi filter hanya produk milik supplier ini saja
            // Supaya supplier tidak melihat barang milik supplier lain dalam order yang sama
            $query->whereHas('product', function($q) use ($supplierId) {
                $q->where('user_id', $supplierId);
            })->with('product');
        }])
        ->latest()
        ->get();

        return view('supplier.order.masuk', compact('orders'));
    }

    // === 2. KONFIRMASI / PROSES PESANAN ===
    public function konfirmasiProses($id)
    {
        // Ubah status order menjadi 'shipping' (Dikirim)
        // Catatan: Dalam sistem real, ini biasanya parsial per item, 
        // tapi untuk simulasi kita update status Order utamanya.
        
        $order = Order::find($id);
        
        if($order) {
            $order->status = 'shipping'; // Ubah ke Dikirim
            $order->save();
            return redirect()->back()->with('success', 'Pesanan diterima dan status diubah menjadi Dikirim.');
        }

        return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
    }

    // === 3. HALAMAN PENGIRIMAN (INPUT RESI) ===
    public function pengiriman()
    {
        $supplierId = Auth::id();

        // Cari order yang statusnya 'shipping' (Sedang Dikirim/Butuh Resi)
        $orders = Order::whereHas('items.product', function($query) use ($supplierId) {
            $query->where('user_id', $supplierId);
        })
        ->where('status', 'shipping')
        ->with(['user', 'items.product'])
        ->latest()
        ->get();

        return view('supplier.order.pengiriman', compact('orders'));
    }

    // === 4. PROSES INPUT RESI ===
    public function inputResi(Request $request, $id)
    {
        $request->validate([
            'resi' => 'required|string|max:50'
        ]);

        $order = Order::find($id);
        
        if($order) {
            $order->resi = $request->resi;
            $order->status = 'completed'; // Simulasi: Input resi langsung dianggap Selesai/Terkirim
            $order->save();
            return redirect()->back()->with('success', 'Resi berhasil diinput. Pesanan Selesai.');
        }

        return redirect()->back()->with('error', 'Gagal input resi.');
    }

    // === 5. RIWAYAT ===
    public function riwayat()
    {
        $supplierId = Auth::id();
        
        $orders = Order::whereHas('items.product', function($query) use ($supplierId) {
            $query->where('user_id', $supplierId);
        })
        ->where('status', 'completed')
        ->with(['user', 'items.product'])
        ->latest()
        ->get();

        return view('supplier.order.riwayat', compact('orders'));
    }
    
    // Placeholder Show (Detail) agar tidak error route
    public function show($id) {
        // Bisa dibuat view detail jika perlu
        return redirect()->route('supplier.order.masuk');
    }
}