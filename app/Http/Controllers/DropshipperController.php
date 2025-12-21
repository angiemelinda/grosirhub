<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\Product;
use App\Models\Category;

class DropshipperController extends Controller
{
    public function dashboard()
    {
        // Get top selling products (sorted by stock as a proxy for popularity)
        $topProducts = Product::with(['category'])
            ->where('status', 'active')
            ->orderBy('stock', 'desc')
            ->take(12)
            ->get();

        // Get newest products
        $newProducts = Product::with(['category'])
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->take(12)
            ->get();

        // Get categories for the category section
        $categories = Category::orderBy('name')
            ->take(8)
            ->get();

        return view('dropshipper.dashboard', [
            'topProducts' => $topProducts,
            'newProducts' => $newProducts,
            'categories' => $categories,
        ]);
    }

    public function catalog(Request $request)
    {
        $query = Product::query()->with('category');

        if ($search = $request->string('search')->toString()) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($categoryId = $request->integer('category')) {
            $query->where('category_id', $categoryId);
        }

        if ($min = $request->input('price_min')) {
            $query->where('price', '>=', (float) $min);
        }
        if ($max = $request->input('price_max')) {
            $query->where('price', '<=', (float) $max);
        }
        if ($request->boolean('in_stock')) {
            $query->where('stock', '>', 0);
        }
        switch ($request->input('sort')) {
            case 'termurah':
                $query->orderBy('price', 'asc');
                break;
            case 'terbaru':
                $query->orderBy('created_at', 'desc');
                break;
            case 'terlaris':
                $query->orderBy('stock', 'desc');
                break;
            default:
                $query->orderBy('name', 'asc');
        }

        $products = $query->paginate(12)->withQueryString();
        $topProducts = Product::query()
            ->where('status', 'active')
            ->orderByDesc('stock')
            ->limit(6)
            ->get();
        $categories = Category::orderBy('name')->get();

        return view('dropshipper.catalog', compact('products', 'categories', 'topProducts'));
    }

    public function productShow(Product $product)
    {
        return view('dropshipper.product-show', compact('product'));
    }

    public function orderItems()
    {
        $products = Product::orderBy('name')->get();
        $orders = $this->emptyPaginator();
        return view('dropshipper.order-items', compact('products', 'orders'));
    }

    public function orderItemsStore(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        return back()->with('success', 'Order berhasil dibuat (demo).');
    }

    public function orderHistory(Request $request)
    {
        $orders = $this->emptyPaginator();
        return view('dropshipper.order-history', compact('orders'));
    }
    
    public function cart()
    {
        return view('dropshipper.cart');
    }

    public function orders()
    {
        $orders = [
            [
                'id' => 'GH-240921',
                'date' => '2024-09-21',
                'supplier' => 'PT Sumber Makmur',
                'product' => 'Earbuds X2 (50 pcs)',
                'total' => 1250000,
                'payment' => 'pending',
                'shipping' => 'processing',
                'resi' => null,
                'courier' => null,
                'estimate' => null,
                'margin' => 350000,
            ],
            [
                'id' => 'GH-240922',
                'date' => '2024-09-22',
                'supplier' => 'PT Nusantara Abadi',
                'product' => 'Kabel Data C (100 pcs)',
                'total' => 820000,
                'payment' => 'paid',
                'shipping' => 'shipped',
                'resi' => 'INV123456789',
                'courier' => 'JNE',
                'estimate' => '3 hari',
                'margin' => 160000,
            ],
            [
                'id' => 'GH-240923',
                'date' => '2024-09-23',
                'supplier' => 'PT Mandiri Sejahtera',
                'product' => 'Adaptor 20W (30 pcs)',
                'total' => 2120000,
                'payment' => 'paid',
                'shipping' => 'completed',
                'resi' => 'INV987654321',
                'courier' => 'SiCepat',
                'estimate' => 'Selesai',
                'margin' => 420000,
            ],
        ];
        $pagination = '';
        return view('dropshipper.orders', compact('orders', 'pagination'));
    }

    public function orderShow(string $id)
    {
        $order = [
            'id' => $id,
            'status' => 'created',
            'supplier' => 'Supplier A',
            'total' => 1250000,
            'margin' => 150000,
            'resi' => 'INV123456789',
            'courier' => 'JNE',
            'items' => [
                ['name' => 'Produk X', 'qty' => 2],
                ['name' => 'Produk Y', 'qty' => 1],
            ],
        ];
        return view('dropshipper.order-detail', compact('order'));
    }

    public function profile()
    {
        return view('dropshipper.profile');
    }

    public function payments()
    {
        return view('dropshipper.payments');
    }

    public function tracking()
    {
        return view('dropshipper.tracking');
    }

    public function transactions()
    {
        return view('dropshipper.transactions');
    }

    public function reports()
    {
        return view('dropshipper.reports');
    }

    private function emptyPaginator(): LengthAwarePaginator
    {
        $items = new Collection([]);
        return new LengthAwarePaginator($items, 0, 10, 1, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
    }
}

