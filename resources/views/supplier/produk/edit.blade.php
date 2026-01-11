@extends('layouts.supplier')

@section('title', 'Edit Produk')
@section('content')

<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg mt-6">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Edit Produk</h2>
        <a href="{{ route('supplier.produk.index') }}" class="text-gray-500 hover:text-orange-500 transition">
            &larr; Kembali
        </a>
    </div>

    <form action="{{ route('supplier.produk.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- PENTING: Untuk memberitahu Laravel ini adalah Update --}}

        {{-- Preview Gambar Saat Ini --}}
        <div class="mb-6 text-center">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Produk Saat Ini</label>
            <div class="relative w-40 h-40 mx-auto rounded-lg overflow-hidden border border-gray-200">
                <img src="{{ $product->image_url }}" class="w-full h-full object-cover">
            </div>
            <p class="text-xs text-gray-500 mt-2">Upload foto baru di bawah jika ingin mengganti.</p>
        </div>

        {{-- Input Gambar Baru --}}
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Ganti Foto (Opsional)</label>
            <input type="file" name="image" class="w-full border p-2 rounded-lg text-sm">
        </div>

        {{-- Nama Produk --}}
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-orange-500 focus:border-orange-500" required>
        </div>

        {{-- Kategori --}}
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
            <select name="category_id" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-orange-500 focus:border-orange-500">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Harga & Stok --}}
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full border border-gray-300 rounded-lg p-2.5" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full border border-gray-300 rounded-lg p-2.5" required>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex gap-4">
            <button type="submit" class="flex-1 bg-orange-600 text-white font-bold py-3 rounded-lg hover:bg-orange-700 transition">
                Simpan Perubahan
            </button>
            <a href="{{ route('supplier.produk.index') }}" class="flex-1 bg-gray-100 text-gray-700 font-bold py-3 rounded-lg hover:bg-gray-200 transition text-center">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection