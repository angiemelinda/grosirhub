@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <!-- Order Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Pesanan #{{ $order->order_code }}</h1>
                <p class="text-gray-600">Dibuat pada {{ $order->created_at->format('d M Y H:i') }}</p>
            </div>
            <div class="text-right">
                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'processing' => 'bg-blue-100 text-blue-800',
                        'shipping' => 'bg-indigo-100 text-indigo-800',
                        'completed' => 'bg-green-100 text-green-800',
                        'cancelled' => 'bg-red-100 text-red-800'
                    ];
                    $statusLabels = [
                        'pending' => 'Menunggu Pembayaran',
                        'processing' => 'Diproses',
                        'shipping' => 'Dikirim',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan'
                    ];
                    $status = $order->status;
                @endphp
                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                    {{ $statusLabels[$status] ?? ucfirst($status) }}
                </span>
            </div>
        </div>

        <!-- Order Details -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <!-- Customer Information -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-medium text-gray-900 mb-3">Informasi Pelanggan</h3>
                <div class="space-y-2 text-sm text-gray-600">
                    <p><span class="font-medium">Nama:</span> {{ $order->user->name ?? 'Tidak ada' }}</p>
                    <p><span class="font-medium">Email:</span> {{ $order->user->email ?? 'Tidak ada' }}</p>
                    <p><span class="font-medium">No. Telepon:</span> {{ $order->shipping_phone ?? '-' }}</p>
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-medium text-gray-900 mb-3">Alamat Pengiriman</h3>
                <div class="space-y-2 text-sm text-gray-600">
                    <p class="font-medium">{{ $order->shipping_name }}</p>
                    <p>{{ $order->shipping_address }}</p>
                    <p>{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-medium text-gray-900 mb-3">Ringkasan Pesanan</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Ongkos Kirim</span>
                        <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Biaya Platform</span>
                        <span>Rp {{ number_format($order->platform_fee, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t border-gray-200 my-2"></div>
                    <div class="flex justify-between font-medium text-gray-900">
                        <span>Total</span>
                        <span>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="mb-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Daftar Produk</h3>
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    @foreach($order->items as $item)
                        <li class="p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-16 w-16 bg-gray-200 rounded-md overflow-hidden">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full bg-gray-200 flex items-center justify-center text-gray-400">
                                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex justify-between text-base font-medium text-gray-900">
                                        <h4>{{ $item->product->name ?? 'Produk dihapus' }}</h4>
                                        <p class="ml-4">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                    </div>
                                    <p class="text-sm text-gray-500">
                                        {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </p>
                                    @if($item->supplier)
                                        <p class="text-xs text-gray-500 mt-1">
                                            Dijual oleh: {{ $item->supplier->name ?? 'Supplier' }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="bg-gray-50 p-4 rounded-lg mb-8">
            <h3 class="font-medium text-gray-900 mb-3">Informasi Pembayaran</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Metode Pembayaran</p>
                    <p class="font-medium">{{ $order->payment_method ?? 'Transfer Bank' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Status Pembayaran</p>
                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $order->payment_status === 'paid' ? 'Lunas' : 'Menunggu Pembayaran' }}
                    </span>
                </div>
                @if($order->payment_proof)
                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-600 mb-2">Bukti Pembayaran</p>
                        <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="inline-block">
                            <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran" class="h-32 w-auto rounded-md border border-gray-200">
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Order Actions -->
        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
            <a href="{{ url()->previous() }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                Kembali
            </a>
            
            @if(auth()->user()->hasRole('dropshipper') && $order->status === 'pending')
                <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    Upload Bukti Pembayaran
                </a>
            @endif
            
            @if(auth()->user()->hasRole('supplier') && $order->status === 'processing')
                <form action="{{ route('supplier.order.konfirmasi', $order->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Konfirmasi Pengiriman
                    </button>
                </form>
            @endif
            
            @if(auth()->user()->hasRole('admin') && $order->status === 'pending')
                <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Setujui Pembayaran
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
