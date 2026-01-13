@extends('layouts.dropshipper')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 font-display">Riwayat Pesanan</h1>
        <p class="text-gray-600">Lihat semua pesanan yang telah selesai</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Pesanan Selesai</p>
                <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['total_orders'] }}</h3>
                <p class="text-xs text-gray-400 mt-1">Sejak bergabung</p>
            </div>
            <div class="p-3 bg-orange-100 rounded-full text-orange-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Pengeluaran</p>
                <h3 class="text-3xl font-bold text-gray-900 mt-1">Rp {{ number_format($stats['total_spend'] / 1000000, 1, ',', '.') }}Jt</h3>
                <p class="text-xs text-gray-400 mt-1">Semua transaksi</p>
            </div>
            <div class="p-3 bg-green-100 rounded-full text-green-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Produk Dibeli</p>
                <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['items_bought'] }}</h3>
                <p class="text-xs text-gray-400 mt-1">Total pcs / unit</p>
            </div>
            <div class="p-3 bg-blue-100 rounded-full text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="font-bold text-gray-900 text-lg">Daftar Semua Transaksi</h2>
            <div class="flex items-center space-x-2">
                <a href="{{ route('dropshipper.orders') }}" class="text-sm bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition">Pesanan Aktif</a>
                <span class="text-gray-300">|</span>
                <a href="{{ route('dropshipper.order-history') }}" class="text-sm text-orange-600 font-medium">Riwayat Pesanan</a>
            </div>
        </div>

        <div class="divide-y divide-gray-100">
            @forelse($orders as $order)
                <div class="p-6 hover:bg-gray-50 transition">
                    <div class="flex flex-wrap justify-between items-start gap-4 mb-4">
                        <div class="flex items-center gap-3">
                            @php
                                $statusColors = [
                                    'pending' => ['bg-yellow-100 text-yellow-600', 'Menunggu Pembayaran'],
                                    'processing' => ['bg-blue-100 text-blue-600', 'Diproses'],
                                    'shipping' => ['bg-indigo-100 text-indigo-600', 'Dikirim'],
                                    'completed' => ['bg-green-100 text-green-600', 'Selesai'],
                                    'cancelled' => ['bg-red-100 text-red-600', 'Dibatalkan']
                                ];
                                $status = $statusColors[$order->status] ?? $statusColors['pending'];
                            @endphp
                            <div class="p-2 {{ $status[0] }} rounded-lg">
                                @if($order->status === 'completed')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                @elseif($order->status === 'processing')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                @elseif($order->status === 'shipping')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                                @elseif($order->status === 'cancelled')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                @endif
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm">{{ $order->order_code }}</p>
                                <p class="text-xs text-gray-500">{{ $order->created_at->format('d M Y') }} • {{ $status[1] }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">Total Belanja</p>
                            <p class="font-bold text-gray-900">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="space-y-3 pl-12">
                        @foreach($order->items->take(2) as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">{{ $item->product->name ?? 'Produk dihapus' }} <span class="text-gray-400">x{{ $item->quantity }}</span></span>
                                <span class="text-gray-900 font-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                        @if($order->items->count() > 2)
                            <p class="text-xs text-gray-400 italic">+ {{ $order->items->count() - 2 }} produk lainnya</p>
                        @endif
                    </div>

                    <div class="mt-4 pl-12 flex gap-3">
                        <a href="{{ route('dropshipper.order.show', $order->id) }}" class="text-primary text-sm font-medium hover:underline">Lihat Detail Transaksi</a>
                        <span class="text-gray-300">|</span>
                        <a href="{{ route('dropshipper.catalog') }}" class="text-gray-600 text-sm font-medium hover:text-gray-900">Beli Lagi</a>
                    </div>
                </div>
            @empty
                <div class="p-10 text-center">
                    <p class="text-gray-500">Belum ada riwayat transaksi selesai.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection