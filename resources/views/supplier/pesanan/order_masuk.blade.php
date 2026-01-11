{{-- Pastikan extends ini sesuai dengan nama layout utama Anda, misal: layouts.supplier atau layouts.app --}}
@extends('layouts.supplier') 

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Order Masuk</h6>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th>No Order</th>
                            <th>Tanggal</th>
                            <th>Dropshipper</th>
                            <th>Item Produk</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->order_code ?? $order->id }}</td>
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td>{{ $order->user->name ?? 'User Terhapus' }}</td>
                            <td>
                                <ul class="pl-3 mb-0">
                                @foreach($order->items as $item)
                                    <li>{{ $item->product->name }} (x{{ $item->quantity }})</li>
                                @endforeach
                                </ul>
                            </td>
                            <td>
                                <span class="badge badge-warning">Perlu Proses</span>
                            </td>
                            <td>
                                {{-- Tombol Konfirmasi --}}
                                <form action="{{ route('supplier.order.konfirmasi', $order->id) }}" method="POST" onsubmit="return confirm('Proses pesanan ini sekarang?');">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-check"></i> Proses Sekarang
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada order masuk yang perlu diproses.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection