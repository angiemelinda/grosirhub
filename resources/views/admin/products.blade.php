@extends('layouts.admin')

@section('title', 'Produk')

@section('content')
<div class="grid grid-3">
    <div class="card">
        <div class="card-header">Ringkasan Produk</div>
        <div class="card-body">
            <ul class="stats-list">
                <li>Total Produk: <strong>{{ $summary['total'] ?? 0 }}</strong></li>
                <li>Stok Rendah: <strong>{{ $summary['low_stock'] ?? 0 }}</strong></li>
                <li>Nonaktif: <strong>{{ $summary['inactive'] ?? 0 }}</strong></li>
            </ul>
            <div class="actions">
                <button class="btn btn-outline">Import CSV</button>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Tambah Produk</div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('admin.products.store') }}" class="grid grid-3">
                @csrf
                <input type="text" name="sku" class="input" placeholder="SKU" value="{{ old('sku') }}">
                <input type="text" name="name" class="input" placeholder="Nama Produk" value="{{ old('name') }}">
                <select name="category_id" class="input">
                    <option value="">Tanpa Kategori</option>
                    @foreach($categories ?? [] as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <input type="number" step="0.01" name="price" class="input" placeholder="Harga" value="{{ old('price', 0) }}">
                <input type="number" name="stock" class="input" placeholder="Stok" value="{{ old('stock', 0) }}">
                <select name="status" class="input">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                <div class="actions">
                    <button class="btn btn-orange" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Aktivitas Terbaru</div>
        <div class="card-body">
            <ul class="activity-list">
                <li>Belum ada aktivitas.</li>
            </ul>
        </div>
    </div>
</div>

<div class="card mt-16">
    <div class="card-header">Daftar Produk</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products ?? [] as $p)
                        <tr>
                            <td>{{ $p->sku }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->category->name ?? '-' }}</td>
                            <td>Rp {{ number_format($p->price, 2, ',', '.') }}</td>
                            <td>{{ $p->stock }}</td>
                            <td>{{ ucfirst($p->status) }}</td>
                            <td>
                                <button class="btn btn-outline">Edit</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(method_exists(($products ?? null), 'links'))
            <div class="pagination mt-12">{{ $products->links() }}</div>
        @endif
    </div>
</div>
@endsection