@extends('layouts.admin')

@section('title', 'Kategori')

@section('content')
<div class="grid grid-2">
    <div class="card">
        <div class="card-header">Ringkasan Kategori</div>
        <div class="card-body">
            <ul class="stats-list">
                <li>Total Kategori: <strong>{{ $summary['total'] ?? 0 }}</strong></li>
                <li>Kategori Aktif: <strong>{{ $summary['active'] ?? 0 }}</strong></li>
            </ul>
            <div class="mt-12">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form method="POST" action="{{ route('admin.categories.store') }}" class="grid grid-2">
                    @csrf
                    <input type="text" name="name" class="input" placeholder="Nama kategori" value="{{ old('name') }}">
                    <label class="checkbox">
                        <input type="checkbox" name="active" value="1" {{ old('active', 1) ? 'checked' : '' }}> Aktif
                    </label>
                    <div class="actions">
                        <button class="btn btn-orange" type="submit">Tambah Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Daftar Kategori</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories ?? [] as $c)
                            <tr>
                                <td>{{ $c->name }}</td>
                                <td>{{ $c->slug }}</td>
                                <td>{{ $c->active ? 'Aktif' : 'Nonaktif' }}</td>
                                <td><button class="btn btn-outline">Edit</button></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(method_exists(($categories ?? null), 'links'))
                <div class="pagination mt-12">{{ $categories->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection