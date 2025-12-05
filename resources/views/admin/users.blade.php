@extends('layouts.admin')

@section('title', 'Pengguna')

@section('content')
<div class="grid grid-3">
    <div class="card">
        <div class="card-header">Ringkasan Pengguna</div>
        <div class="card-body">
            <ul class="stats-list">
                <li>Total Pengguna: <strong>0</strong></li>
                <li>Super Admin: <strong>1</strong></li>
                <li>Supplier: <strong>0</strong></li>
                <li>Dropshipper: <strong>0</strong></li>
            </ul>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Filter Cepat</div>
        <div class="card-body">
            <div class="grid grid-2">
                <input type="text" class="input" placeholder="Cari nama / email">
                <select class="input">
                    <option>Semua Peran</option>
                    <option>Super Admin</option>
                    <option>Supplier</option>
                    <option>Dropshipper</option>
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
            <button class="btn btn-orange">Tambah Pengguna</button>
            <button class="btn btn-outline">Export</button>
        </div>
    </div>
</div>

<div class="card mt-16">
    <div class="card-header">Daftar Pengguna</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Peran</th>
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