<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // PENTING: Untuk hapus gambar
use App\Models\Product;
use App\Models\Category;
use App\Models\Image; 

class ProdukController extends Controller
{
    // --- 1. MENAMPILKAN DAFTAR PRODUK ---
    public function index(Request $request)
    {
        // === FITUR AUTO-FIX: ISI KATEGORI (DENGAN SLUG) ===
        $kategoriWajib = ['Tas', 'Sepatu', 'Pakaian', 'Aksesoris', 'Elektronik', 'Lain-lain'];
        
        foreach($kategoriWajib as $nama) {
            Category::firstOrCreate(
                ['name' => $nama], 
                ['slug' => Str::slug($nama)]
            );
        }
        // =========================================================

        $supplierId = Auth::id();
        $query = Product::where('user_id', $supplierId);

        // Filter Kategori
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        // Search
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->with(['category'])->latest()->paginate(12);
        $categories = Category::all();

        return view('supplier.produk.index', compact('products', 'categories'));
    }

    // --- 2. MENYIMPAN PRODUK BARU ---
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan Produk
        $product = Product::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'sku' => 'PRD-' . time() . rand(100,999),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status ?? 'active',
        ]);

        // Simpan Gambar
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            Image::create([
                'product_id' => $product->id,
                'path' => $path,
                'is_primary' => true
            ]);
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'Produk berhasil ditambahkan!']);
        }

        return redirect()->route('supplier.produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // --- 3. MENAMPILKAN HALAMAN EDIT ---
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        
        return view('supplier.produk.edit', compact('product', 'categories'));
    }

    // --- 4. MENYIMPAN PERUBAHAN (UPDATE) ---
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);

        // Update Data Utama
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status ?? 'active',
        ]);

        // Update Gambar (Jika ada upload baru)
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            $oldImage = $product->primaryImage;
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage->path);
                $oldImage->delete();
            }

            // Upload gambar baru
            $path = $request->file('image')->store('products', 'public');
            
            // Simpan ke database
            Image::create([
                'product_id' => $product->id,
                'path' => $path,
                'is_primary' => true
            ]);
        }

        return redirect()->route('supplier.produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // --- 5. MENGHAPUS PRODUK ---
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus semua gambar fisik terkait produk ini
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        // Hapus data produk
        $product->delete();

        return redirect()->route('supplier.produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}