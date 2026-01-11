@extends('layouts.supplier')

@section('title', 'Produk')
@section('header', 'Produk')

@section('content')

    {{-- Konten Utama --}}
    <div class="flex-1 p-4">
        
        {{-- Header Banner --}}
        <div class="mb-8 relative w-full h-52 rounded-2xl overflow-hidden shadow-lg bg-gradient-to-r from-orange-500 to-red-500">
            <div class="p-6 flex justify-between items-center h-full relative z-10">
                <div class="w-2/3">
                    <h2 class="text-3xl font-bold mb-2 text-white drop-shadow-md">Kelola Produk Anda</h2>
                    <p class="text-white/95 mb-6 text-lg drop-shadow">Upload produk baru dan atur stok dengan mudah.</p>
                    <button onclick="openAddProductModal()" 
                       class="inline-block bg-white text-orange-600 font-bold px-6 py-3 rounded-full shadow-lg hover:bg-gray-100 transform hover:scale-105 transition duration-300">
                        + Tambah Produk
                    </button>
                </div>
                <div class="h-full flex items-center">
                    {{-- Ilustrasi Gudang --}}
                    <img src="https://cdn-icons-png.flaticon.com/512/6021/6021194.png" class="h-44 object-contain drop-shadow-2xl opacity-90 transform -rotate-6">
                </div>
            </div>
            {{-- Pattern Overlay --}}
            <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
        </div>

        {{-- 1. KATEGORI PRODUK (IKON SESUAI NAMA) --}}
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <span class="bg-orange-100 text-orange-600 p-1 rounded">📂</span> Kategori
                </h3>
                @if(request('category_id'))
                    <a href="{{ route('supplier.produk.index') }}" class="text-sm text-red-500 hover:underline font-medium">Reset Filter ✕</a>
                @endif
            </div>

            <div class="flex flex-wrap gap-4">
                @php
                    $iconMap = [
                        'Tas'        => 'https://img.icons8.com/fluency/96/backpack.png',
                        'Sepatu'     => 'https://img.icons8.com/?size=100&id=39712&format=png&color=000000',
                        'Pakaian'    => 'https://img.icons8.com/?size=100&id=117332&format=png&color=000000',
                        'Aksesoris'  => 'https://img.icons8.com/?size=100&id=kdaAXarYIW0d&format=png&color=000000',
                        'Elektronik' => 'https://img.icons8.com/fluency/96/imac.png',
                        'Lain-lain'  => 'https://img.icons8.com/fluency/96/open-box.png',
                    ];
                @endphp

                @foreach($categories as $category)
                    @php
                        $iconUrl = $iconMap[$category->name] ?? 'https://img.icons8.com/fluency/96/box.png';
                        $isActive = request('category_id') == $category->id;
                    @endphp

                    <a href="{{ route('supplier.produk.index', ['category_id' => $category->id]) }}" 
                       class="group bg-white border {{ $isActive ? 'border-orange-500 ring-2 ring-orange-200 bg-orange-50' : 'border-gray-100' }} hover:border-orange-300 shadow-sm hover:shadow-md rounded-xl px-4 py-4 cursor-pointer text-center min-w-[100px] flex-1 transition-all duration-300 transform hover:-translate-y-1">
                        
                        <div class="h-14 w-14 mx-auto mb-2 flex items-center justify-center rounded-full {{ $isActive ? 'bg-white shadow-sm' : 'bg-gray-50 group-hover:bg-white' }} transition">
                           <img src="{{ $iconUrl }}" alt="{{ $category->name }}" class="h-10 w-10 object-contain">
                        </div>
                        
                        <span class="text-gray-700 font-semibold text-sm group-hover:text-orange-600 block truncate">
                            {{ $category->name }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- 2. DAFTAR PRODUK --}}
        <div class="mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                📦 Daftar Produk {{ request('category_id') ? '(Difilter)' : '' }}
            </h3>

            {{-- Pesan Sukses --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($products as $produk)
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-lg transition duration-300 p-4 flex flex-col relative group">
                    
                    {{-- Gambar Produk --}}
                    <div class="h-48 mb-4 rounded-lg overflow-hidden relative bg-gray-50 border group-hover:border-orange-200 transition">
                        <img src="{{ $produk->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $produk->name }}">
                    </div>
                    
                    <h4 class="font-bold text-gray-800 text-lg mb-1 leading-tight line-clamp-2">{{ $produk->name }}</h4>
                    <p class="text-xs text-gray-500 mb-3 bg-gray-100 inline-block px-2 py-1 rounded">{{ $produk->category->name ?? 'Tanpa Kategori' }}</p>
                    
                    <div class="mt-auto">
                        <p class="text-orange-600 font-bold text-xl mb-2">Rp {{ number_format($produk->price, 0,',','.') }}</p>
                        
                        <div class="flex items-center justify-between mb-4 text-sm">
                            @if($produk->stock > 0)
                                <span class="text-green-700 bg-green-100 px-2 py-0.5 rounded text-xs font-bold flex items-center gap-1">
                                    ● Stok: {{ $produk->stock }}
                                </span>
                            @else
                                <span class="text-red-700 bg-red-100 px-2 py-0.5 rounded text-xs font-bold flex items-center gap-1">
                                    ● Habis
                                </span>
                            @endif
                        </div>
                        
                        {{-- TOMBOL AKSI: EDIT & HAPUS (YANG DIPERBAIKI) --}}
                        <div class="grid grid-cols-2 gap-2">
                             {{-- Tombol Edit --}}
                             <a href="{{ route('supplier.produk.edit', $produk->id) }}" 
                                class="text-center border border-gray-300 text-gray-600 hover:bg-yellow-50 hover:text-yellow-600 hover:border-yellow-400 px-3 py-2 rounded-lg text-sm font-medium transition flex items-center justify-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit
                             </a>

                             {{-- Tombol Hapus (Form) --}}
                             <form action="{{ route('supplier.produk.destroy', $produk->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk {{ $produk->name }}? Data tidak bisa dikembalikan.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-center bg-red-50 border border-red-100 text-red-500 hover:bg-red-500 hover:text-white px-3 py-2 rounded-lg text-sm font-medium transition flex items-center justify-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Hapus
                                </button>
                             </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-16 bg-white rounded-xl border border-dashed border-gray-300">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" class="h-24 mx-auto opacity-50 mb-4 grayscale">
                    <h4 class="text-lg font-semibold text-gray-600">Belum ada produk di sini</h4>
                    <p class="text-gray-500 mb-4">Mulai tambahkan produk pertamamu!</p>
                    <button onclick="openAddProductModal()" class="text-orange-500 font-medium hover:underline">
                        + Tambah Produk Sekarang
                    </button>
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $products->links() }} 
            </div>
        </div>

    </div>

    {{-- 3. MODAL TAMBAH PRODUK (SAMA SEPERTI SEBELUMNYA) --}}
    <div id="addProductModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 backdrop-blur-sm transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto transform scale-100 transition-transform duration-300">
            <div class="sticky top-0 bg-white border-b px-6 py-4 flex justify-between items-center z-10">
                <h2 class="text-xl font-bold text-gray-800">Tambah Produk</h2>
                <button onclick="closeAddProductModal()" class="text-gray-400 hover:text-red-500 text-2xl transition">&times;</button>
            </div>

            <form id="addProductForm" class="p-6 space-y-5" enctype="multipart/form-data">
                @csrf
                <div id="errorMessages" class="hidden bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm"></div>

                {{-- INPUT GAMBAR --}}
                <div>
                    <label class="block mb-1.5 text-sm font-semibold text-gray-700">Foto Produk</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:bg-orange-50 hover:border-orange-300 transition cursor-pointer relative group">
                        <input type="file" name="image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" onchange="previewImage(this)">
                        
                        <div id="imagePreviewContainer" class="group-hover:scale-105 transition duration-300">
                            <div class="bg-gray-100 h-12 w-12 rounded-full flex items-center justify-center mx-auto mb-2 text-gray-400">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <p class="text-sm font-medium text-gray-600">Klik untuk upload</p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG (Max 2MB)</p>
                        </div>
                        <img id="imagePreview" class="hidden h-40 w-full object-contain rounded-lg relative z-10">
                    </div>
                </div>

                <div>
                    <label class="block mb-1.5 text-sm font-semibold text-gray-700">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" name="name" placeholder="Contoh: Tas Sekolah Keren" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition" required>
                </div>

                <div>
                    <label class="block mb-1.5 text-sm font-semibold text-gray-700">Kategori</label>
                    <div class="relative">
                        <select name="category_id" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition appearance-none bg-white" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1.5 text-sm font-semibold text-gray-700">Harga (Rp)</label>
                        <input type="number" name="price" placeholder="0" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-orange-500 outline-none transition" required>
                    </div>
                    <div>
                        <label class="block mb-1.5 text-sm font-semibold text-gray-700">Stok</label>
                        <input type="number" name="stock" placeholder="0" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-orange-500 outline-none transition" required>
                    </div>
                </div>

                <button type="submit" id="submitBtn" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-xl shadow-lg hover:shadow-xl transition transform active:scale-95">
                    Simpan Produk
                </button>
            </form>
        </div>
    </div>

    {{-- Javascript --}}
    <script>
        function openAddProductModal() { document.getElementById('addProductModal').classList.remove('hidden'); }
        function closeAddProductModal() { document.getElementById('addProductModal').classList.add('hidden'); }

        function previewImage(input) {
            const container = document.getElementById('imagePreviewContainer');
            const preview = document.getElementById('imagePreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    container.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.getElementById('addProductForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('submitBtn');
            const errorDiv = document.getElementById('errorMessages');
            
            btn.disabled = true;
            btn.innerHTML = '<span class="inline-block animate-spin mr-2">↻</span> Menyimpan...';
            errorDiv.classList.add('hidden');

            try {
                const formData = new FormData(this);
                const response = await fetch('{{ route("supplier.produk.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const data = await response.json();

                if (response.ok) {
                    alert('Produk berhasil disimpan! 🚀');
                    location.reload();
                } else {
                    errorDiv.classList.remove('hidden');
                    errorDiv.innerText = data.message || 'Terjadi kesalahan.';
                }
            } catch (error) {
                console.error(error);
                alert('Gagal menghubungi server.');
            } finally {
                btn.disabled = false;
                btn.innerText = 'Simpan Produk';
            }
        });
    </script>
@endsection