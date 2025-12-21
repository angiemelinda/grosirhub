@extends('layouts.dropshipper')

@section('title', 'Detail Pesanan')
@section('header', 'Detail Pesanan')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow p-5">
            <div class="flex justify-between items-start">
                <div>
                    <div class="text-xs text-gray-500">Order ID</div>
                    <div class="text-lg font-semibold text-gray-900">{{ $order['id'] ?? 'ORD-0001' }}</div>
                </div>
                <div>
                    @php $s = $order['status'] ?? 'created'; @endphp
                    @if($s === 'paid')
                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Dibayar</span>
                    @elseif($s === 'processing')
                        <span class="px-2 py-1 text-xs rounded bg-orange-100 text-orange-700">Diproses</span>
                    @elseif($s === 'shipped')
                        <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700">Dikirim</span>
                    @else
                        <span class="px-2 py-1 text-xs rounded bg-orange-100 text-orange-700">Menunggu pembayaran</span>
                    @endif
                </div>
            </div>
            <div class="mt-3 text-sm text-gray-600">
                <div>Supplier: {{ $order['supplier'] ?? '-' }}</div>
                <div>Total: Rp {{ number_format($order['total'] ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <h3 class="text-lg font-semibold mb-3">Produk</h3>
            <div class="space-y-3">
                @foreach(($order['items'] ?? []) as $item)
                <div class="flex justify-between text-sm text-gray-700">
                    <div>{{ $item['name'] }}</div>
                    <div>x{{ $item['qty'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <h3 class="text-lg font-semibold mb-3">Tracking Pengiriman</h3>
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                    <span class="text-sm text-gray-700">Order Dibuat</span>
                </div>
                <span class="h-px w-8 bg-gray-300"></span>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 {{ ($order['status'] ?? '') === 'paid' || ($order['status'] ?? '') === 'processing' || ($order['status'] ?? '') === 'shipped' ? 'bg-green-500' : 'bg-gray-300' }} rounded-full"></span>
                    <span class="text-sm text-gray-700">Dibayar</span>
                </div>
                <span class="h-px w-8 bg-gray-300"></span>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 {{ ($order['status'] ?? '') === 'processing' || ($order['status'] ?? '') === 'shipped' ? 'bg-orange-500' : 'bg-gray-300' }} rounded-full"></span>
                    <span class="text-sm text-gray-700">Diproses Supplier</span>
                </div>
                <span class="h-px w-8 bg-gray-300"></span>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 {{ ($order['status'] ?? '') === 'shipped' ? 'bg-blue-500' : 'bg-gray-300' }} rounded-full"></span>
                    <span class="text-sm text-gray-700">Dikirim</span>
                </div>
            </div>
            <div class="mt-3 text-sm text-gray-600">
                <div>Nomor Resi: <span class="font-medium">{{ $order['resi'] ?? '-' }}</span></div>
                <div>Ekspedisi: <span class="font-medium">{{ $order['courier'] ?? '-' }}</span></div>
            </div>
        </div>
    </div>

    <div>
        <div class="bg-white rounded-xl shadow p-5">
            <h3 class="text-lg font-semibold mb-3">Pembayaran</h3>
            @if(($order['status'] ?? 'created') === 'created')
                <a href="#" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-orange-500 text-white hover:bg-orange-600">
                    Bayar Sekarang
                </a>
                <div class="text-xs text-gray-500 mt-2">Midtrans Sandbox</div>
            @else
                <div class="text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg p-3">Pesanan sudah dibayar</div>
            @endif
        </div>
        <div class="bg-white rounded-xl shadow p-5 mt-6">
            <h3 class="text-lg font-semibold mb-3">Ringkasan</h3>
            <div class="flex justify-between text-sm text-gray-600">
                <span>Total</span>
                <span>Rp {{ number_format($order['total'] ?? 0, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm text-gray-600">
                <span>Estimasi Margin (internal)</span>
                <span>Rp {{ number_format($order['margin'] ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection

