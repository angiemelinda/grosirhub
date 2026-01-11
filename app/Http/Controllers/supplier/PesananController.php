<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;     // Pastikan Model Order ada
use App\Models\Product;   // Pastikan Model Product ada

class PesananController extends Controller
{
    // ==========================================================
    // MENU 3: ORDER MASUK
    // (Menampilkan order yang baru masuk atau sudah dibayar, tapi belum diproses)
    // ==========================================================
    public function orderMasuk()
    {
        $supplierId = Auth::id();

        // Ambil order yang statusnya masih 'menunggu_pembayaran' atau 'sudah_dibayar'
        // dan mengandung produk milik supplier ini
        $orders = Order::whereHas('items.product', function($q) use ($supplierId) {
            $q->where('user_id', $supplierId);
        })
        ->whereIn('status', ['belum_dibayar', 'sudah_dibayar']) // Filter Status
        ->with(['user', 'items.product'])
        ->latest()
        ->get();

        return view('supplier.pesanan.order_masuk', compact('orders'));
    }

    // Fungsi untuk tombol "Konfirmasi Diproses" (Masuk ke Menu Pengiriman)
    public function konfirmasiProses($id)
    {
        $order = Order::findOrFail($id);
        
        // Ubah status menjadi 'dikemas' agar pindah ke menu Pengiriman
        $order->status = 'dikemas';
        $order->save();

        return redirect()->route('supplier.pengiriman')->with('success', 'Order dikonfirmasi & masuk ke menu Pengiriman.');
    }


    // ==========================================================
    // MENU 4: PENGIRIMAN
    // (Menampilkan order yang sedang dikemas atau dikirim + Input Resi)
    // ==========================================================
    public function pengiriman()
    {
        $supplierId = Auth::id();

        // Ambil order yang statusnya 'dikemas' atau 'dikirim'
        $orders = Order::whereHas('items.product', function($q) use ($supplierId) {
            $q->where('user_id', $supplierId);
        })
        ->whereIn('status', ['dikemas', 'dikirim']) // Filter Status
        ->with(['user', 'items.product'])
        ->latest()
        ->get();

        return view('supplier.pesanan.pengiriman', compact('orders'));
    }

    // Fungsi untuk Input Nomor Resi
    public function inputResi(Request $request, $id)
    {
        $request->validate([
            'resi' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        
        $order->update([
            'resi' => $request->resi,
            'status' => 'dikirim', // Otomatis ubah status jadi dikirim
        ]);

        return back()->with('success', 'Resi berhasil diinput.');
    }


    // ==========================================================
    // MENU 5: RIWAYAT TRANSAKSI
    // (Menampilkan order yang sudah selesai)
    // ==========================================================
    public function riwayat()
    {
        $supplierId = Auth::id();

        $orders = Order::whereHas('items.product', function($q) use ($supplierId) {
            $q->where('user_id', $supplierId);
        })
        ->where('status', 'selesai') // Filter Status Selesai
        ->with(['user', 'items.product'])
        ->latest()
        ->get();

        return view('supplier.pesanan.riwayat', compact('orders'));
    }
}