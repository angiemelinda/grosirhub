@extends('layouts.dropshipper')

@section('title', 'Dashboard Dropshipper')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 animate-slide-down">
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl p-6 text-white shadow-lg md:col-span-3 lg:col-span-1 relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-2xl font-bold font-display mb-1">Halo, {{ Auth::user()->name }}! 👋</h2>
                <p class="text-orange-100 text-sm mb-4">Siap kebanjiran orderan hari ini?</p>
                <a href="{{ route('dropshipper.catalog') }}" class="inline-block bg-white text-orange-600 px-4 py-2 rounded-lg text-sm font-bold shadow-sm hover:bg-orange-50 transition">
                    Mulai Belanja
                </a>
            </div>
            <div class="absolute right-0 bottom-0 opacity-20 transform translate-x-4 translate-y-4">
                <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M20 7h-4v-3c0-2.209-1.791-4-4-4s-4 1.791-4 4v3h-4l-2 17h20l-2-17zm-11-3c0-1.654 1.346-3 3-3s3 1.346 3 3v3h-6v-3zm-4.751 15l1.529-13h12.444l1.529 13h-15.502z"/></svg>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-blue-50 rounded-full text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total Pesanan</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $totalPesanan }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-green-50 rounded-full text-green-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total Pengeluaran</p>
                <h3 class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-900 font-display">Produk Teratas</h2>
        <a href="{{ route('dropshipper.catalog') }}" class="text-primary hover:text-primary-dark font-medium text-sm flex items-center gap-1">
            Lihat Semua <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
        </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-lg transition duration-300 flex flex-col h-full overflow-hidden group">
            
            <div class="relative h-48 bg-gray-50 overflow-hidden">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                <div class="absolute top-2 right-2">
                    <span class="bg-white/90 backdrop-blur text-gray-700 text-[10px] font-bold px-2 py-1 rounded shadow-sm border">
                        Stok: {{ $product->stock }}
                    </span>
                </div>
            </div>

            <div class="p-4 flex flex-col flex-1">
                <div class="text-xs text-gray-500 mb-1">{{ $product->category->name ?? 'Umum' }}</div>
                <h4 class="font-bold text-gray-900 text-sm mb-2 line-clamp-2 leading-tight flex-1">
                    {{ $product->name }}
                </h4>
                
                <div class="mb-3">
                    <span class="text-lg font-bold text-primary font-display">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                    <span class="text-xs text-gray-400">/pcs</span>
                </div>

                <div class="bg-gray-50 rounded-lg p-2 mb-3 border border-gray-100">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-gray-500">Min. Order:</span>
                        {{-- UPDATE DISINI JADI 15 --}}
                        <span class="font-bold text-gray-800">{{ $product->min_order ?? 15 }} pcs</span>
                    </div>
                </div>

                <form action="{{ route('dropshipper.cart.add') }}" method="POST" class="mt-auto">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    {{-- Default Quantity = 15 --}}
                    <input type="hidden" name="quantity" value="{{ $product->min_order ?? 15 }}">

                    <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg text-sm font-semibold hover:bg-primary-dark transition flex items-center justify-center gap-2 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Keranjang
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full py-12 text-center text-gray-500">
            Belum ada produk yang tersedia saat ini.
        </div>
        @endforelse
    </div>

</div>
@endsection