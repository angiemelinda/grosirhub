@extends('layouts.supplier')

@section('title', 'Order Masuk')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Order Masuk</h2>
            <p class="text-sm text-gray-500">Pesanan dari dropshipper yang perlu dikemas.</p>
        </div>
        <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-xs font-bold">
            {{ $orders->count() }} Perlu Proses
        </span>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm uppercase">
                    <th class="p-4 border-b">No Order</th>
                    <th class="p-4 border-b">Dropshipper</th>
                    <th class="p-4 border-b">Produk Dipesan</th>
                    <th class="p-4 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 align-top">
                        <span class="font-bold text-gray-800 block">{{ $order->order_code }}</span>
                        <span class="text-xs text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</span>
                    </td>
                    <td class="p-4 align-top">
                        <div class="font-medium text-gray-900">{{ $order->user->name ?? 'User Hapus' }}</div>
                        <div class="text-xs text-gray-500">{{ $order->user->email }}</div>
                    </td>
                    <td class="p-4">
                        <div class="space-y-2">
                            @foreach($order->items as $item)
                            <div class="flex items-center gap-3 bg-gray-50 p-2 rounded">
                                <img src="{{ $item->product->image_url }}" class="w-10 h-10 rounded object-cover border">
                                <div>
                                    <p class="text-sm font-bold text-gray-800">{{ $item->product->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $item->quantity }} pcs x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="p-4 align-top text-center">
                        <form action="{{ route('supplier.order.konfirmasi', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition shadow-sm w-full">
                                Proses & Kemas
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-gray-500">
                        Belum ada orderan masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection