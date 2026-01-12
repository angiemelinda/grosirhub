@extends('layouts.dropshipper')

@section('title', 'Pesanan Saya')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 font-display">Pesanan Saya</h1>
        <p class="text-gray-600">Pantau status pesanan dan pengiriman Anda secara real-time</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <a href="{{ route('dropshipper.orders', ['status' => 'unpaid']) }}" class="bg-yellow-50 border border-yellow-100 p-6 rounded-xl hover:shadow-md transition cursor-pointer">
            <div class="flex justify-between items-start">
                <div class="p-3 bg-yellow-100 rounded-lg text-yellow-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-3xl font-bold text-gray-800">{{ $counts['unpaid'] }}</span>
            </div>
            <h3 class="font-bold text-gray-900 mt-4">Belum Bayar</h3>
            <p class="text-xs text-gray-500">Selesaikan pembayaran</p>
        </a>

        <a href="{{ route('dropshipper.orders', ['status' => 'processing']) }}" class="bg-blue-50 border border-blue-100 p-6 rounded-xl hover:shadow-md transition cursor-pointer">
            <div class="flex justify-between items-start">
                <div class="p-3 bg-blue-100 rounded-lg text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                </div>
                <span class="text-3xl font-bold text-gray-800">{{ $counts['processing'] }}</span>
            </div>
            <h3 class="font-bold text-gray-900 mt-4">Dikemas</h3>
            <p class="text-xs text-gray-500">Pesanan disiapkan</p>
        </a>

        <a href="{{ route('dropshipper.orders', ['status' => 'shipping']) }}" class="bg-purple-50 border border-purple-100 p-6 rounded-xl hover:shadow-md transition cursor-pointer">
            <div class="flex justify-between items-start">
                <div class="p-3 bg-purple-100 rounded-lg text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0 2 2 0 00-4 0zm10 0a2 2 0 104 0 2 2 0 00-4 0z"></path></svg>
                </div>
                <span class="text-3xl font-bold text-gray-800">{{ $counts['shipping'] }}</span>
            </div>
            <h3 class="font-bold text-gray-900 mt-4">Dikirim</h3>
            <p class="text-xs text-gray-500">Dalam pengiriman</p>
        </a>

        <div class="bg-green-50 border border-green-100 p-6 rounded-xl">
            <div class="flex justify-between items-start">
                <div class="p-3 bg-green-100 rounded-lg text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-3xl font-bold text-gray-800">{{ $counts['completed'] }}</span>
            </div>
            <h3 class="font-bold text-gray-900 mt-4">Selesai</h3>
            <p class="text-xs text-gray-500">Pesanan diterima</p>
        </div>
    </div>

    <div class="space-y-6">
        <div class="flex space-x-6 border-b border-gray-200 mb-6 overflow-x-auto">
            <a href="{{ route('dropshipper.orders') }}" class="pb-3 text-sm font-medium {{ !request('status') ? 'border-b-2 border-orange-500 text-orange-600' : 'text-gray-500 hover:text-gray-700' }}">
                Semua ({{ $orders->count() }})
            </a>
            <a href="{{ route('dropshipper.orders', ['status' => 'unpaid']) }}" class="pb-3 text-sm font-medium {{ request('status') == 'unpaid' ? 'border-b-2 border-orange-500 text-orange-600' : 'text-gray-500 hover:text-gray-700' }}">
                Belum Bayar
            </a>
            <a href="{{ route('dropshipper.orders', ['status' => 'processing']) }}" class="pb-3 text-sm font-medium {{ request('status') == 'processing' ? 'border-b-2 border-orange-500 text-orange-600' : 'text-gray-500 hover:text-gray-700' }}">
                Dikemas
            </a>
            <a href="{{ route('dropshipper.orders', ['status' => 'shipping']) }}" class="pb-3 text-sm font-medium {{ request('status') == 'shipping' ? 'border-b-2 border-orange-500 text-orange-600' : 'text-gray-500 hover:text-gray-700' }}">
                Dikirim
            </a>
        </div>

        @forelse($orders as $order)
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex flex-wrap justify-between items-center gap-4">
                    <div class="flex items-center gap-4">
                        <div class="p-2 bg-orange-100 rounded text-orange-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">No. Pesanan</p>
                            <p class="font-bold text-gray-800">{{ $order->order_code }}</p>
                        </div>
                        <div class="hidden md:block h-8 w-px bg-gray-300 mx-2"></div>
                        <div class="hidden md:block">
                            <p class="text-xs text-gray-500">Tanggal</p>
                            <p class="text-sm text-gray-800">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    
                    @if($order->payment_status == 'unpaid')
                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">Menunggu Pembayaran</span>
                    @elseif($order->status == 'processing')
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">Sedang Dikemas</span>
                    @elseif($order->status == 'shipping')
                        <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold">Dalam Pengiriman</span>
                    @endif
                </div>

                <div class="p-6">
                    @foreach($order->items as $item)
                    <div class="bg-white px-6 py-4 border-t border-gray-100 flex flex-wrap justify-between items-center gap-4">
                    <div>
                        <p class="text-xs text-gray-500">Total Pembayaran</p>
                        <p class="text-xl font-bold text-primary">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('dropshipper.order.show', $order->id) }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50">
                            Lihat Detail
                        </a>

                        @if($order->payment_status == 'unpaid')
                            <form action="{{ route('dropshipper.checkout') }}" method="POST"> 
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded-lg text-sm font-bold hover:bg-orange-700 shadow-sm">
                                    Bayar Sekarang
                                </button>
                            </form>

                        @elseif($order->status == 'processing')
                            <button class="px-4 py-2 bg-gray-100 text-gray-500 rounded-lg text-sm font-bold cursor-not-allowed">
                                Menunggu Resi
                            </button>

                        @elseif($order->status == 'shipping')
                            <a href="{{ route('dropshipper.order.complete', $order->id) }}" class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-bold hover:bg-green-700 shadow-sm">
                                Terima Pesanan
                            </a>

                        @elseif($order->status == 'completed')
                             <span class="px-4 py-2 bg-green-50 text-green-700 rounded-lg text-sm font-bold border border-green-200">
                                Selesai
                            </span>
                        @endif
                    </div>
                </div>
                    @endforeach
                </div>

                <div class="bg-white px-6 py-4 border-t border-gray-100 flex flex-wrap justify-between items-center gap-4">
                    <div>
                        <p class="text-xs text-gray-500">Total Pembayaran</p>
                        <p class="text-xl font-bold text-primary">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('dropshipper.order.show', $order->id) }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50">
                            Lihat Detail
                        </a>

                        @if($order->payment_status == 'unpaid')
                            <form action="{{ route('dropshipper.checkout') }}" method="POST"> @csrf
                                <a href="{{ route('dropshipper.order.show', $order->id) }}" class="inline-block px-4 py-2 bg-orange-600 text-white rounded-lg text-sm font-bold hover:bg-orange-700 shadow-sm">
                                    Bayar Sekarang
                                </a>
                            </form>
                        @elseif($order->status == 'shipping')
                            <button class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-bold hover:bg-green-700 shadow-sm">
                                Terima Pesanan
                            </button>
                        @else
                            <button class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg text-sm font-bold cursor-not-allowed">
                                Menunggu Proses
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16 bg-white rounded-xl border border-dashed border-gray-300">
                <div class="inline-block p-4 rounded-full bg-gray-100 mb-4">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Belum ada pesanan</h3>
                <p class="text-gray-500 mb-6">Yuk mulai belanja stok produk!</p>
                <a href="{{ route('dropshipper.catalog') }}" class="bg-primary text-white px-6 py-2 rounded-lg font-medium hover:bg-primary-dark">Ke Katalog</a>
            </div>
        @endforelse
    </div>
</div>
@endsection