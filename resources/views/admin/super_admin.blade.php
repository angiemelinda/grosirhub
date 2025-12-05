@extends('layouts.admin')

@section('title', 'Super Admin')

@section('content')
<div class="grid">
    <div class="card">
        <div class="card-header">
            <h3>Ringkasan Sistem</h3>
        </div>
        <div class="card-body stats">
            <div class="stat">
                <span class="stat-value">128</span>
                <span class="stat-label">Produk</span>
            </div>
            <div class="stat">
                <span class="stat-value">14</span>
                <span class="stat-label">Kategori</span>
            </div>
            <div class="stat">
                <span class="stat-value">36</span>
                <span class="stat-label">Supplier</span>
            </div>
            <div class="stat">
                <span class="stat-value">58</span>
                <span class="stat-label">Dropshipper</span>
            </div>
            <div class="stat">
                <span class="stat-value">247</span>
                <span class="stat-label">Transaksi</span>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Aksi Cepat</h3>
        </div>
        <div class="card-body actions">
            <a href="/produk" class="btn btn-orange">Kelola Produk</a>
            <a href="#" class="btn btn-outline-orange">Kelola Kategori</a>
            <a href="#" class="btn btn-orange">Kelola Pengguna</a>
            <a href="#" class="btn btn-outline-orange">Pantau Transaksi</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Aktivitas Terbaru</h3>
        </div>
        <div class="card-body">
            <ul class="activity-list">
                <li><span class="dot"></span> Pesanan #INV-2025-001 dibayar oleh John Doe</li>
                <li><span class="dot"></span> Produk "Tas Kulit" diperbarui stok oleh Supplier A</li>
                <li><span class="dot"></span> Dropshipper B menambahkan 5 produk baru</li>
                <li><span class="dot"></span> Kategori "Elektronik" diubah oleh Admin Produk</li>
            </ul>
        </div>
    </div>
</div>
@endsection