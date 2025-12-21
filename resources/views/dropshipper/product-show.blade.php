@extends('layouts.dropshipper')

@section('title', 'Detail Produk')
@section('header', 'Detail Produk')

@section('content')
<div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div>
        <div class="aspect-square bg-gray-100 rounded-2xl flex items-center justify-center overflow-hidden">
            <div class="text-gray-400">Gambar Produk</div>
        </div>
        <div class="mt-4 grid grid-cols-4 gap-3">
            <div class="aspect-square bg-gray-100 rounded-lg"></div>
            <div class="aspect-square bg-gray-100 rounded-lg"></div>
            <div class="aspect-square bg-gray-100 rounded-lg"></div>
            <div class="aspect-square bg-gray-100 rounded-lg"></div>
        </div>
    </div>
    <div>
        <h2 class="text-2xl font-semibold text-gray-900">{{ $product->name }}</h2>
        <div class="text-sm text-gray-500 mt-1">{{ $product->category->name ?? 'Kategori' }}</div>
        <div class="mt-4">
            <div class="text-sm text-gray-600">Harga grosir</div>
            <div class="text-3xl font-semibold text-orange-600">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
            <div class="text-sm text-gray-500 mt-1">Min. 10 pcs</div>
        </div>
        <div class="mt-6">
            <label class="text-sm text-gray-700">Harga jual Anda</label>
            <input type="number" class="mt-2 w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="Masukkan harga jual">
            <div class="text-xs text-gray-500 mt-1">Estimasi margin: Rp 15.000 / pcs</div>
        </div>
        <div class="mt-6 flex gap-3">
            <button id="addToCartDetail" data-product-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}" class="px-5 py-3 rounded-xl bg-orange-500 text-white hover:bg-orange-600">Tambah ke Keranjang</button>
            <a href="{{ route('dropshipper.catalog') }}" class="px-5 py-3 rounded-xl border border-gray-300 hover:bg-gray-50">Kembali ke Produk</a>
        </div>
    </div>
</div>
@push('scripts')
<script>
    function getCart(){ try{ return JSON.parse(localStorage.getItem('gh_cart')||'[]'); }catch(e){ return []; } }
    function setCart(c){ localStorage.setItem('gh_cart', JSON.stringify(c)); }
    function updateBadge(){ const el=document.getElementById('cart-count'); if(el){ el.textContent=getCart().length||''; el.classList.toggle('hidden', getCart().length===0); } }
    document.addEventListener('DOMContentLoaded', function(){
        updateBadge();
        const btn=document.getElementById('addToCartDetail');
        if(btn){
            btn.addEventListener('click', function(){
                const cart=getCart();
                cart.push({id:this.dataset.productId, name:this.dataset.name, price:parseFloat(this.dataset.price)});
                setCart(cart); updateBadge();
                const toast=document.getElementById('gh-toast'); if(toast){ toast.classList.remove('-translate-y-4','opacity-0'); setTimeout(()=>toast.classList.add('-translate-y-4','opacity-0'),1500); }
            });
        }
    });
</script>
@endpush
@endsection

