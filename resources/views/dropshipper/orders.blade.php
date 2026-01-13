@extends('layouts.dropshipper')

@section('title', 'Pesanan Saya')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Pesanan Saya</h1>
        <p class="text-gray-600">Pantau status pesanan dan pengiriman Anda</p>
    </div>

    {{-- RINGKASAN STATUS --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">

        {{-- BELUM BAYAR --}}
        <a href="{{ route('dropshipper.orders', ['status' => 'pending']) }}"
           class="bg-yellow-50 border p-6 rounded-xl hover:shadow">
            <div class="flex justify-between">
                <span class="text-sm font-medium text-yellow-700">Belum Bayar</span>
                <span class="text-2xl font-bold">{{ $counts['pending'] }}</span>
            </div>
        </a>

        {{-- DIPROSES --}}
        <a href="{{ route('dropshipper.orders', ['status' => 'processing']) }}"
           class="bg-blue-50 border p-6 rounded-xl hover:shadow">
            <div class="flex justify-between">
                <span class="text-sm font-medium text-blue-700">Dikemas</span>
                <span class="text-2xl font-bold">{{ $counts['processing'] }}</span>
            </div>
        </a>

        {{-- DIKIRIM --}}
        <a href="{{ route('dropshipper.orders', ['status' => 'shipping']) }}"
           class="bg-purple-50 border p-6 rounded-xl hover:shadow">
            <div class="flex justify-between">
                <span class="text-sm font-medium text-purple-700">Dikirim</span>
                <span class="text-2xl font-bold">{{ $counts['shipping'] }}</span>
            </div>
        </a>

        {{-- SELESAI --}}
        <div class="bg-green-50 border p-6 rounded-xl">
            <div class="flex justify-between">
                <span class="text-sm font-medium text-green-700">Selesai</span>
                <span class="text-2xl font-bold">{{ $counts['completed'] }}</span>
            </div>
        </div>

    </div>

    {{-- TAB FILTER --}}
    <div class="flex gap-6 border-b mb-6 text-sm">
        <a href="{{ route('dropshipper.orders') }}"
           class="{{ !request('status') ? 'border-b-2 border-orange-500 text-orange-600' : 'text-gray-500' }}">
            Semua
        </a>
        <a href="{{ route('dropshipper.orders', ['status' => 'pending']) }}"
           class="{{ request('status') == 'pending' ? 'border-b-2 border-orange-500 text-orange-600' : 'text-gray-500' }}">
            Belum Bayar
        </a>
        <a href="{{ route('dropshipper.orders', ['status' => 'processing']) }}"
           class="{{ request('status') == 'processing' ? 'border-b-2 border-orange-500 text-orange-600' : 'text-gray-500' }}">
            Dikemas
        </a>
        <a href="{{ route('dropshipper.orders', ['status' => 'shipping']) }}"
           class="{{ request('status') == 'shipping' ? 'border-b-2 border-orange-500 text-orange-600' : 'text-gray-500' }}">
            Dikirim
        </a>
    </div>

    {{-- LIST ORDER --}}
    @forelse($orders as $order)
        <div class="bg-white border rounded-xl mb-6 overflow-hidden">

            {{-- HEADER ORDER --}}
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center">
                <div>
                    <p class="text-xs text-gray-500">No Pesanan</p>
                    <p class="font-bold">{{ $order->order_code }}</p>
                    <p class="text-xs text-gray-500">
                        {{ $order->created_at->format('d M Y H:i') }}
                    </p>
                </div>

                {{-- BADGE STATUS --}}
                @if($order->payment_status === 'pending')
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">
                        Menunggu Pembayaran
                    </span>
                @elseif($order->status === 'processing')
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                        Sedang Dikemas
                    </span>
                @elseif($order->status === 'shipping')
                    <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold">
                        Dalam Pengiriman
                    </span>
                @elseif($order->status === 'completed')
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                        Selesai
                    </span>
                @endif
            </div>

            {{-- ITEM --}}
            <div class="px-6 py-4">
                @foreach($order->items as $item)
                    <div class="flex justify-between py-2 border-b text-sm">
                        <span>
                            {{ $item->product->name ?? 'Produk dihapus' }}
                            (x{{ $item->quantity }})
                        </span>
                        <span>
                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                        </span>
                    </div>
                @endforeach
            </div>

            {{-- TOTAL & ACTION --}}
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center">
                <div>
                    <p class="text-xs text-gray-500">Total Pembayaran</p>
                    <p class="text-lg font-bold">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </p>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('dropshipper.order.show', $order->id) }}"
                       class="px-4 py-2 border rounded-lg text-sm">
                        Detail
                    </a>

                    @if($order->payment_status === 'pending')
                        <a href="{{ route('dropshipper.order.show', $order->id) }}"
                           class="px-4 py-2 bg-orange-600 text-white rounded-lg text-sm font-bold">
                            Bayar Sekarang
                        </a>

                    @elseif($order->status === 'shipping')
                        <form action="{{ route('dropshipper.order.complete', $order->id) }}" method="POST">
                            @csrf
                            <button class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-bold">
                                Terima Pesanan
                            </button>
                        </form>

                    @else
                        <button class="px-4 py-2 bg-gray-200 text-gray-400 rounded-lg text-sm cursor-not-allowed">
                            Menunggu Proses
                        </button>
                    @endif
                </div>
            </div>

        </div>
    @empty
        <div class="text-center py-16 bg-white rounded-xl border border-dashed">
            <p class="text-gray-500">Belum ada pesanan</p>
        </div>
    @endforelse

</div>
@endsection
