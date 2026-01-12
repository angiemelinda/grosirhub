@extends('layouts.dropshipper')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 font-display mb-6">Keranjang Belanja</h1>

    @if(session('cart') && count(session('cart')) > 0)
        <form action="{{ route('dropshipper.checkout') }}" method="POST" id="checkoutForm">
            @csrf
            
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="flex-1 space-y-4">
                    <div class="bg-white p-4 rounded-xl shadow-sm border flex items-center gap-4">
                        <input type="checkbox" id="selectAll" onchange="toggleSelectAll(this)" class="w-5 h-5 text-orange-600 rounded">
                        <label for="selectAll" class="font-semibold text-gray-700 cursor-pointer">Pilih Semua</label>
                    </div>

                    @foreach(session('cart') as $id => $details)
                        <div class="bg-white p-4 rounded-xl shadow-sm border flex items-center gap-4 relative">
                            <input type="checkbox" name="selected_items[]" value="{{ $id }}" 
                                   data-subtotal="{{ $details['price'] * $details['quantity'] }}"
                                   onchange="calculateTotal()"
                                   class="item-checkbox w-5 h-5 text-orange-600 rounded">

                            <div class="h-20 w-20 bg-gray-100 rounded-lg overflow-hidden">
                                <img src="{{ $details['image'] }}" class="h-full w-full object-cover">
                            </div>

                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900">{{ $details['name'] }}</h3>
                                <p class="text-orange-600 font-bold">Rp {{ number_format($details['price'], 0, ',', '.') }}</p>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="flex items-center border rounded-lg">
                                    <button type="button" onclick="updateQty('{{ $id }}', {{ $details['quantity'] - 1 }})" class="px-3 py-1 bg-gray-100 hover:bg-gray-200">-</button>
                                    <span class="px-3 font-bold">{{ $details['quantity'] }}</span>
                                    <button type="button" onclick="updateQty('{{ $id }}', {{ $details['quantity'] + 1 }})" class="px-3 py-1 bg-gray-100 hover:bg-gray-200">+</button>
                                </div>
                                
                                <button type="button" onclick="removeItem('{{ $id }}')" class="text-red-500 hover:text-red-700 ml-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="w-full lg:w-96 h-fit sticky top-24">
                    <div class="bg-white p-6 rounded-xl shadow-lg border">
                        <h2 class="text-lg font-bold mb-4">Ringkasan Pesanan</h2>
                        <div class="flex justify-between mb-6">
                            <span>Total Bayar</span>
                            <span id="displayTotal" class="text-2xl font-bold text-orange-600">Rp 0</span>
                        </div>
                        <button type="submit" id="btnCheckout" disabled class="w-full bg-gray-300 text-white font-bold py-3 rounded-xl transition cursor-not-allowed">
                            Checkout Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </form>

        {{-- Form Update Hidden --}}
        <form id="updateForm" action="{{ route('dropshipper.cart.update') }}" method="POST" class="hidden">
            @csrf @method('PATCH')
            <input type="hidden" name="id" id="updateId">
            <input type="hidden" name="quantity" id="updateQty">
        </form>

        {{-- Form Hapus Hidden --}}
        <form id="removeForm" action="{{ route('dropshipper.cart.remove') }}" method="POST" class="hidden">
            @csrf @method('DELETE')
            <input type="hidden" name="id" id="removeId">
        </form>

    @else
        <div class="text-center py-20">
            <h2 class="text-2xl font-bold text-gray-800">Keranjang Kosong</h2>
            <a href="{{ route('dropshipper.catalog') }}" class="text-orange-600 hover:underline mt-2 inline-block">Belanja Dulu Yuk</a>
        </div>
    @endif
</div>

<script>
    function calculateTotal() {
        let total = 0;
        let count = 0;
        const checkboxes = document.querySelectorAll('.item-checkbox');
        const btn = document.getElementById('btnCheckout');
        const display = document.getElementById('displayTotal');

        checkboxes.forEach(cb => {
            if (cb.checked) {
                total += parseFloat(cb.getAttribute('data-subtotal'));
                count++;
            }
        });

        display.innerText = 'Rp ' + total.toLocaleString('id-ID');

        if (count > 0) {
            btn.disabled = false;
            btn.classList.remove('bg-gray-300', 'cursor-not-allowed');
            btn.classList.add('bg-orange-600', 'hover:bg-orange-700');
        } else {
            btn.disabled = true;
            btn.classList.add('bg-gray-300', 'cursor-not-allowed');
            btn.classList.remove('bg-orange-600', 'hover:bg-orange-700');
        }
    }

    function toggleSelectAll(source) {
        const checkboxes = document.querySelectorAll('.item-checkbox');
        checkboxes.forEach(cb => {
            cb.checked = source.checked;
        });
        calculateTotal();
    }

    function updateQty(id, qty) {
        if(qty < 1) return;
        document.getElementById('updateId').value = id;
        document.getElementById('updateQty').value = qty;
        document.getElementById('updateForm').submit();
    }

    function removeItem(id) {
        if(confirm('Hapus barang ini?')) {
            document.getElementById('removeId').value = id;
            document.getElementById('removeForm').submit();
        }
    }
</script>
@endsection