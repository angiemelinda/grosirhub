@extends('layouts.supplier')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Riwayat Pesanan Selesai</h2>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm uppercase">
                    <th class="p-4 border-b">No Order</th>
                    <th class="p-4 border-b">Tanggal Selesai</th>
                    <th class="p-4 border-b">No Resi</th>
                    <th class="p-4 border-b text-right">Total Pendapatan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-bold text-gray-800">{{ $order->order_code }}</td>
                    <td class="p-4 text-sm">{{ $order->updated_at->format('d M Y') }}</td>
                    <td class="p-4"><span class="font-mono bg-gray-100 px-2 py-1 rounded">{{ $order->resi }}</span></td>
                    <td class="p-4 text-right font-bold text-green-600">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-gray-500">Belum ada riwayat pesanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection