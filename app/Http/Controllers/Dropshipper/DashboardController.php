<?php

namespace App\Http\Controllers\Dropshipper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        // 1. Statistik (Biarkan seperti semula)
        $totalPesanan = Order::where('user_id', $userId)->count();
        $totalBelanja = Order::where('user_id', $userId)->sum('total'); 
        
        // 2. AMBIL PRODUK UNTUK "PRODUK TERATAS"
        // Kita ambil 8 produk terbaru yang aktif dan ada stoknya
        $products = Product::where('status', 'active')
                           ->where('stock', '>', 0)
                           ->latest()
                           ->take(8)
                           ->get();

        return view('dropshipper.dashboard', compact('totalPesanan', 'totalBelanja', 'products'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('dropshipper.profile', compact('user'));
    }

    public function tracking() { return view('dropshipper.tracking'); }
    public function reports() { return view('dropshipper.reports'); }
}