<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order; // Pastikan pakai Model Order yang benar
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $supplierId = Auth::id();

        // ==========================================
        // 1. DATA KARTU STATISTIK
        // ==========================================
        
        // Total Produk milik supplier
        $totalProduk = Product::where('user_id', $supplierId)->count();
        
        // Total Stok
        $totalStok = Product::where('user_id', $supplierId)->sum('stock');
        
        // Produk Stok Habis
        $outOfStock = Product::where('user_id', $supplierId)->where('stock', 0)->count();
        
        // Total Pesanan (Cari order yang mengandung produk supplier ini)
        $totalOrders = Order::whereHas('items.product', function($query) use ($supplierId) {
            $query->where('user_id', $supplierId);
        })->where('status', '!=', 'belum_dibayar')->count();


        // ==========================================
        // 2. TABEL PESANAN TERBARU
        // ==========================================
        // Kita ambil 5 order terakhir yang relevan
        $pesananTerbaru = Order::whereHas('items.product', function($query) use ($supplierId) {
                $query->where('user_id', $supplierId);
            })
            ->with(['user']) // Eager load data pemesan (Dropshipper)
            ->latest()
            ->take(5)
            ->get();


        // ==========================================
        // 3. TABEL PRODUK (STOK RENDAH/TERLARIS)
        // ==========================================
        // PENTING: Kita hapus ->map() disini agar 'image_url' dan 'name' terbaca di View
        $produkTeratas = Product::where('user_id', $supplierId)
            ->orderBy('stock', 'asc') // Tampilkan stok paling sedikit dulu (urgent)
            ->take(4)
            ->get();


        // ==========================================
        // 4. KIRIM DATA KE VIEW
        // ==========================================
        return view('supplier.dashboard2', compact(
            'totalProduk',
            'totalOrders',
            'totalStok',
            'outOfStock',
            'pesananTerbaru',
            'produkTeratas'
        ));
    }
}