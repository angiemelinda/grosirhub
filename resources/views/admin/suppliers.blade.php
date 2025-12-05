@extends('layouts.admin')

@section('title', 'Supplier')

@section('content')
<div class="grid grid-3">
    <div class="card">
        <div class="card-header">Ringkasan Supplier</div>
        <div class="card-body">
            <ul class="stats-list">
                <li>Total Supplier: <strong>0</strong></li>
                <li>Aktif: <strong>0</strong></li>
                <li>Nonaktif: <strong>0</strong></li>
            </ul>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Aksi</div>
        <div class="card-body">
            <button class="btn btn-orange">Tambah Supplier</button>
            <button class="btn btn-outline">Import</button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Aktivitas</div>
        <div class="card-body">
            <ul class="activity-list">
                <li>Belum ada aktivitas.</li>
            </ul>
        </div>
    </div>
</div>

<div class="card mt-16">
    <div class="card-header">Daftar Supplier</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <th>Produk</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection