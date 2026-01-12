<?php

namespace App\Http\Controllers\Dropshipper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Ambil produk yang aktif dan ada stoknya
        $query = Product::where('status', 'active')->where('stock', '>', 0);

        // Filter Kategori (Jika ada)
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        // Fitur Pencarian
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Ambil data dengan pagination
        $products = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('dropshipper.catalog', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        // Pastikan view detail produk ada, atau arahkan kembali ke katalog
        if (view()->exists('dropshipper.product-show')) {
            return view('dropshipper.product-show', compact('product'));
        }
        return view('dropshipper.catalog-detail', compact('product')); // Fallback nama file view
    }
}