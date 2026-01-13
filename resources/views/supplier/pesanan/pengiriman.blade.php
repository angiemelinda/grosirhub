@extends('layouts.supplier')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info">Status Pengiriman & Input Resi</h6>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th>No Order</th>
                            <th>Penerima</th>
                            <th>Kurir</th>
                            <th>Status Saat Ini</th>
                            <th>Nomor Resi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->order_code ?? $order->id }}</td>
                            <td>
                                <strong>{{ $order->user->name }}</strong><br>
                                <small class="text-muted">Item: {{ $order->items->count() }} jenis</small>
                            </td>
                            <td>{{ strtoupper($order->courier ?? '-') }}</td>
                            <td>
                                @if($order->status == 'processing')
                                    <span class="badge badge-warning">Sedang Dikemas</span>
                                @else
                                    <span class="badge badge-info">Sedang Dikirim</span>
                                @endif
                            </td>
                            
                            {{-- FORM INPUT RESI --}}
                             <td>
                                <form action="{{ route('supplier.order.input_resi', $order->id) }}" method="POST">
                                    @csrf
                                    <input type="text" name="resi" class="form-control form-control-sm">
                            </td>
                            <td>
                                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Tidak ada pesanan yang sedang diproses.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection