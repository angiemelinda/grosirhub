@extends('layouts.supplier')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

    <div class="flex items-center gap-4 bg-white rounded-xl p-5 shadow hover:shadow-lg transition">
        <div class="bg-orange-500 text-white p-4 rounded-xl">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7l9-4 9 4-9 4-9-4z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 17l9 4 9-4" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9 4 9-4" />
            </svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-900">{{ $totalProduk }}</p>
            <p class="text-sm text-gray-500">Total Produk</p>
        </div>
    </div>

    <div class="flex items-center gap-4 bg-orange-50 rounded-xl p-5 shadow hover:shadow-lg transition">
        <div class="bg-orange-600 text-white p-4 rounded-xl">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18l-2 13H5L3 3z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 16a2 2 0 11-4 0" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 16a2 2 0 11-4 0" />
            </svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</p>
            <p class="text-sm text-gray-600">Total Pesanan</p>
        </div>
    </div>

    <div class="flex items-center gap-4 bg-white rounded-xl p-5 shadow hover:shadow-lg transition">
        <div class="bg-orange-500 text-white p-4 rounded-xl">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16v12H4z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 10h16" />
            </svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-900">{{ $totalStok }}</p>
            <p class="text-sm text-gray-500">Total Stok</p>
        </div>
    </div>

    <div class="flex items-center gap-4 bg-orange-50 rounded-xl p-5 shadow hover:shadow-lg transition">
        <div class="bg-red-500 text-white p-4 rounded-xl">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
            </svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-900">{{ $outOfStock }}</p>
            <p class="text-sm text-gray-600">Stok Habis</p>
        </div>
    </div>

</div>

<div class="bg-white rounded-xl shadow p-6 mt-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-gray-900">Pesanan Terbaru</h2>
        {{-- PERBAIKAN LINK DISINI --}}
        <a href="{{ route('supplier.order.masuk') }}" class="text-sm text-orange-500 hover:underline">
            Lihat Semua
        </a>
    </div>

    <div class="space-y-4">
        @forelse($pesananTerbaru as $pesanan)
        <div class="flex items-center justify-between p-4 border rounded-xl hover:shadow transition">
            
            <div class="flex items-center gap-4">
                <div class="bg-orange-100 text-orange-600 p-3 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18l-2 13H5L3 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 16a2 2 0 11-4 0" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 16a2 2 0 11-4 0" />
                    </svg>
                </div>

                <div>
                    <p class="font-semibold text-gray-800">
                        Pesanan #{{ $pesanan->kode ?? $pesanan->id }}
                    </p>
                    <p class="text-sm text-gray-500">
                        Status: 
                        <span class="
                            @if($pesanan->status == 'belum_dibayar') text-yellow-600
                            @elseif($pesanan->status == 'dikemas') text-blue-600
                            @elseif($pesanan->status == 'dikirim') text-purple-600
                            @else text-green-600 @endif
                        ">
                            {{ ucfirst(str_replace('_', ' ', $pesanan->status)) }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <span class="px-3 py-1 text-xs rounded-full 
                    @if($pesanan->status == 'belum_dibayar') bg-yellow-100 text-yellow-700
                    @elseif($pesanan->status == 'dikemas') bg-blue-100 text-blue-700
                    @elseif($pesanan->status == 'dikirim') bg-purple-100 text-purple-700
                    @else bg-green-100 text-green-700
                    @endif">
                    {{ ucfirst(str_replace('_', ' ', $pesanan->status)) }}
                </span>

                {{-- PERBAIKAN LINK DETAIL (Arahkan ke Order Masuk untuk diproses) --}}
                <a href="{{ route('supplier.order.masuk') }}"
                   class="text-sm text-orange-500 hover:underline font-medium">
                    Proses
                </a>
            </div>
        </div>
        @empty
        <div class="text-center py-4 text-gray-500">Belum ada pesanan terbaru.</div>
        @endforelse
    </div>
</div>

<div class="bg-white p-6 rounded-xl shadow mt-6 space-y-4">
    <div class="flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-900">🔥 Produk Stok Rendah</h2>
        <a href="{{ route('supplier.produk.index') }}" class="text-sm text-orange-500 hover:underline">
            Kelola Produk
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        @forelse($produkTeratas as $produk)
        <div class="flex gap-4 bg-gray-50 rounded-xl p-4 hover:shadow transition">
            
            <div class="w-20 h-20 rounded-lg overflow-hidden bg-gray-200 flex-shrink-0">
                <img 
                    src="{{ $produk->image_url ?? 'https://via.placeholder.com/150' }}" 
                    class="w-full h-full object-cover"
                    alt="{{ $produk->name }}">
            </div>

            <div class="flex-1">
                <h3 class="font-semibold text-gray-900 leading-tight">
                    {{ $produk->name }}
                </h3>

                <div class="mt-2">
                    @if($produk->stock <= 3)
                        <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded-full">
                            ⚠ Stok hampir habis ({{ $produk->stock }})
                        </span>
                    @else
                        <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full">
                            Stok tersedia ({{ $produk->stock }})
                        </span>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-2 text-center py-4 text-gray-500">Stok produk aman.</div>
        @endforelse

    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5 mt-6">

    <a href="{{ route('supplier.produk.create') }}"
       class="bg-white rounded-xl p-5 flex items-center gap-4 shadow hover:shadow-lg transition">
        <div class="bg-orange-100 text-orange-600 p-3 rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 5v14M5 12h14"/>
            </svg>
        </div>
        <div>
            <p class="font-semibold text-gray-900">Tambah Produk</p>
            <p class="text-sm text-gray-500">Upload produk baru</p>
        </div>
    </a>

    <a href="{{ route('supplier.order.masuk') }}"
       class="bg-white rounded-xl p-5 flex items-center gap-4 shadow hover:shadow-lg transition">
        <div class="bg-blue-100 text-blue-600 p-3 rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M3 3h18l-2 13H5L3 3z"/>
                <path d="M16 16a2 2 0 11-4 0"/>
            </svg>
        </div>
        <div>
            <p class="font-semibold text-gray-900">Pesanan Masuk</p>
            <p class="text-sm text-gray-500">Kelola pesanan</p>
        </div>
    </a>

    <a href="{{ route('supplier.produk.index') }}"
       class="bg-white rounded-xl p-5 flex items-center gap-4 shadow hover:shadow-lg transition">
        <div class="bg-green-100 text-green-600 p-3 rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
            </svg>
        </div>
        <div>
            <p class="font-semibold text-gray-900">Stok Produk</p>
            <p class="text-sm text-gray-500">Kelola ketersediaan</p>
        </div>
    </a>

    <a href="{{ route('supplier.riwayat') }}" class="bg-white rounded-xl p-5 flex items-center gap-4 shadow hover:shadow-lg transition">
        <div class="bg-purple-100 text-purple-600 p-3 rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M4 19h16M6 17V7M12 17V4M18 17v-9"/>
            </svg>
        </div>
        <div>
            <p class="font-semibold text-gray-900">Laporan</p>
            <p class="text-sm text-gray-500">Riwayat transaksi</p>
        </div>
    </a>

</div>

@endsection