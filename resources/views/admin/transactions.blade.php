@extends('layouts.admin')

@section('title', 'Transaksi')

@section('content')
<div class="grid grid-3">
    <div class="card">
        <div class="card-header">Ringkasan Transaksi</div>
        <div class="card-body">
            <ul class="stats-list">
                <li>Hari Ini: <strong>0</strong></li>
                <li>Bulan Ini: <strong>0</strong></li>
                <li>Total: <strong>0</strong></li>
            </ul>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Filter Cepat</div>
        <div class="card-body">
            <div class="grid grid-3">
                <input type="date" class="input" placeholder="Dari">
                <input type="date" class="input" placeholder="Sampai">
                <select class="input">
                    <option>Status</option>
                    <option>Pending</option>
                    <option>Berhasil</option>
                    <option>Gagal</option>
                </select>
            </div>
            <div class="actions mt-12">
                <button class="btn btn-outline">Reset</button>
                <button class="btn btn-orange">Terapkan</button>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Aksi</div>
        <div class="card-body">
            <button class="btn btn-outline">Export CSV</button>
        </div>
    </div>
</div>

<div class="card mt-16">
    <div class="card-header">Daftar Transaksi</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection