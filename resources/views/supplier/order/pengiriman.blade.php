@extends('layouts.supplier')

@section('title', 'Perlu Dikirim')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800">Input Resi Pengiriman</h2>
        <p class="text-sm text-gray-500">Masukkan nomor resi agar status berubah menjadi dikirim.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm uppercase">
                    <th class="p-4 border-b">No Order</th>
                    <th class="p-4 border-b">Penerima</th>
                    <th class="p-4 border-b">Kurir</th>
                    <th class="p-4 border-b">Input Resi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-bold text-gray-800">{{ $order->order_code }}</td>
                    <td class="p-4">
                        <div class="font-medium">{{ $order->user->name }}</div>
                        <div class="text-xs text-gray-500">Jakarta (Simulasi)</div>
                    </td>
                    <td class="p-4">
                        <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-xs font-bold">JNE Regular</span>
                    </td>
                    <td class="p-4">
                        <form action="{{ route('supplier.order.input_resi', $order->id) }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="text" name="resi" placeholder="Contoh: JP12345678" class="border rounded px-3 py-2 text-sm w-full focus:ring-2 focus:ring-blue-500 outline-none" required>
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded text-sm font-bold hover:bg-green-700">
                                Kirim
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-gray-500">
                        Tidak ada pesanan yang perlu dikirim.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection