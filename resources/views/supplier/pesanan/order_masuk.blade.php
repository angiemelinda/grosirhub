@extends('layouts.supplier') @section('title', 'Order Masuk')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Daftar Order Masuk</h2>
            <p class="text-sm text-gray-500">Pesanan baru yang perlu Anda proses dan kemas.</p>
        </div>
        <div class="p-2 bg-orange-50 text-orange-600 rounded-lg font-bold">
            {{ $orders->count() }} Pesanan Baru
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                    <th class="p-4 border-b">No Order</th>
                    <th class="p-4 border-b">Tanggal</th>
                    <th class="p-4 border-b">Dropshipper</th>
                    <th class="p-4 border-b">Item Produk</th>
                    <th class="p-4 border-b text-center">Status</th>
                    <th class="p-4 border-b text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 font-bold text-gray-800">
                        {{ $order->order_code }}
                    </td>
                    <td class="p-4 text-sm text-gray-500">
                        {{ $order->created_at->format('d M Y H:i') }}
                    </td>
                    <td class="p-4">
                        <div class="font-medium text-gray-900">{{ $order->user->name ?? 'User Hapus' }}</div>
                        <div class="text-xs text-gray-500">{{ $order->user->email ?? '-' }}</div>
                    </td>
                    <td class="p-4">
                        @foreach($order->items as $item)
                            <div class="flex items-center gap-2 mb-2">
                                <img src="{{ $item->product->image_url ?? '' }}" class="w-8 h-8 rounded object-cover bg-gray-100">
                                <div>
                                    <p class="text-xs font-bold text-gray-800">{{ $item->product->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $item->quantity }} pcs x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </td>
                    <td class="p-4 text-center">
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                            Perlu Dikemas
                        </span>
                    </td>
                    <td class="p-4 text-right">
                        <form action="{{ route('supplier.order.konfirmasi', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-orange-700 shadow-sm transition">
                                Proses Pesanan
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            <p>Belum ada order masuk yang perlu diproses.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection