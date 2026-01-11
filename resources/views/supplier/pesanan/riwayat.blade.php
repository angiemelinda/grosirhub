@extends('layouts.supplier')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Riwayat Transaksi Selesai</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tgl Selesai</th>
                            <th>No Order</th>
                            <th>Total Pendapatan</th>
                            <th>Resi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->updated_at->format('d/m/Y') }}</td>
                            <td>#{{ $order->order_code ?? $order->id }}</td>
                            <td>Rp {{ number_format($order->items->sum('subtotal'), 0, ',', '.') }}</td>
                            <td>{{ $order->resi ?? '-' }}</td>
                            <td><span class="badge badge-success">Selesai</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada riwayat transaksi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection