<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - GrosirHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#f97316',
                        'primary-dark': '#ea580c',
                        'primary-light': '#fed7aa',
                    },
                    fontFamily: {
                        'display': ['Outfit', 'sans-serif'],
                        'body': ['DM Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Outfit', sans-serif; }
        .product-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .product-card:hover { transform: translateY(-4px); }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="bg-gray-50">
    
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0">
                    <a href="{{ route('dropshipper.dashboard') }}" class="text-2xl font-bold text-primary font-display">GrosirHub</a>
                </div>

                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('dropshipper.dashboard') }}" class="text-gray-700 hover:text-primary font-medium {{ request()->routeIs('dropshipper.dashboard') ? 'text-primary font-semibold border-b-2 border-primary pb-1' : '' }}">Beranda</a>
                    <a href="{{ route('dropshipper.catalog') }}" class="font-medium {{ request()->routeIs('dropshipper.catalog') ? 'text-primary font-semibold border-b-2 border-primary pb-1' : 'text-gray-700 hover:text-primary' }}">Produk</a>
                    <a href="{{ route('dropshipper.orders') }}" class="text-gray-700 hover:text-primary font-medium {{ request()->routeIs('dropshipper.orders') ? 'text-primary font-semibold border-b-2 border-primary pb-1' : '' }}">Pesanan</a>
                    <a href="{{ route('dropshipper.order-history') }}" class="text-gray-700 hover:text-primary font-medium {{ request()->routeIs('dropshipper.order-history') ? 'text-primary font-semibold border-b-2 border-primary pb-1' : '' }}">Riwayat</a>
                </div>

                <div class="flex items-center space-x-4">
                    <form action="{{ route('dropshipper.catalog') }}" method="GET" class="hidden md:block w-64">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-4 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Cari produk...">
                        </div>
                    </form>

                    <a href="{{ route('dropshipper.cart') }}" class="text-gray-700 hover:text-primary relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="absolute -top-2 -right-2 bg-primary text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-semibold">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>

                    <div class="relative group">
                        <button class="w-9 h-9 bg-primary rounded-full flex items-center justify-center text-white font-semibold cursor-pointer text-sm">
                            {{ substr(Auth::user()->name ?? 'U', 0, 2) }}
                        </button>
                        <div class="hidden group-hover:block absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50 border">
                            <a href="{{ route('dropshipper.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profil Saya</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mb-20 md:mb-0">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2 font-display">Katalog Grosir</h1>
            <p class="text-gray-600">Dapatkan harga terbaik dengan pembelian minimum yang terjangkau.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
                <p class="font-bold">Sukses!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-6">
            <aside class="w-full lg:w-64 flex-shrink-0">
                <div class="bg-white rounded-xl shadow-sm p-5 sticky top-24 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-gray-900 font-display">Kategori</h3>
                        @if(request()->has('category_id'))
                            <a href="{{ route('dropshipper.catalog') }}" class="text-primary text-xs font-medium hover:underline">Reset</a>
                        @endif
                    </div>
                    <div class="space-y-1 max-h-[70vh] overflow-y-auto custom-scrollbar pr-2">
                        @foreach($categories as $category)
                        <a href="{{ route('dropshipper.catalog', ['category_id' => $category->id]) }}" class="flex items-center justify-between p-2 rounded-lg transition {{ request('category_id') == $category->id ? 'bg-orange-50 text-primary font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                            <span class="text-sm">{{ $category->name }}</span>
                            @if(request('category_id') == $category->id)
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>
            </aside>

            <div class="flex-1">
                @if(request('category_id'))
                <div class="mb-4 flex items-center gap-2">
                    <span class="text-sm text-gray-500">Menampilkan kategori:</span>
                    <span class="bg-orange-100 text-primary px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $categories->find(request('category_id'))->name ?? 'Semua' }}
                    </span>
                </div>
                @endif

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @forelse($products as $product)
                    <div class="product-card bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md flex flex-col h-full overflow-hidden relative">
                        
                        <div class="relative h-48 bg-gray-50 group">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            <div class="absolute top-2 right-2">
                                <span class="bg-white/90 backdrop-blur text-gray-700 text-[10px] font-bold px-2 py-1 rounded shadow-sm border">
                                    Stok: {{ $product->stock }}
                                </span>
                            </div>
                        </div>

                        <div class="p-4 flex flex-col flex-1">
                            <div class="text-xs text-gray-500 mb-1">{{ $product->category->name ?? 'Umum' }}</div>
                            <h4 class="font-bold text-gray-900 text-sm mb-2 line-clamp-2 leading-tight flex-1">
                                {{ $product->name }}
                            </h4>
                            
                            <div class="mb-3">
                                <span class="text-lg font-bold text-primary font-display">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                                <span class="text-xs text-gray-400">/pcs</span>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-2 mb-3 border border-gray-100">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-gray-500">Min. Order:</span>
                                    {{-- DEFAULT DIUBAH JADI 15 --}}
                                    <span class="font-bold text-gray-800">{{ $product->min_order ?? 15 }} pcs</span>
                                </div>
                            </div>

                            <form action="{{ route('dropshipper.cart.add') }}" method="POST" class="mt-auto">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                {{-- Otomatis set qty ke minimum order (15) --}}
                                <input type="hidden" name="quantity" value="{{ $product->min_order ?? 15 }}">

                                <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg text-sm font-semibold hover:bg-primary-dark transition flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-12 text-center">
                        <div class="inline-block p-4 rounded-full bg-gray-100 mb-3">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <p class="text-gray-500 font-medium">Produk tidak ditemukan.</p>
                        <a href="{{ route('dropshipper.catalog') }}" class="text-primary text-sm hover:underline mt-2 inline-block">Lihat Semua Produk</a>
                    </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </main>

    <div class="md:hidden bg-white border-t border-gray-200 fixed bottom-0 left-0 right-0 z-50 flex justify-around items-center h-16 shadow-[0_-2px_10px_rgba(0,0,0,0.05)]">
        <a href="{{ route('dropshipper.dashboard') }}" class="flex flex-col items-center justify-center {{ request()->routeIs('dropshipper.dashboard') ? 'text-primary' : 'text-gray-500' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span class="text-[10px] mt-1">Beranda</span>
        </a>
        <a href="{{ route('dropshipper.catalog') }}" class="flex flex-col items-center justify-center {{ request()->routeIs('dropshipper.catalog') ? 'text-primary' : 'text-gray-500' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
            <span class="text-[10px] mt-1 font-semibold">Produk</span>
        </a>
        <a href="{{ route('dropshipper.orders') }}" class="flex flex-col items-center justify-center {{ request()->routeIs('dropshipper.orders') ? 'text-primary' : 'text-gray-500' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            <span class="text-[10px] mt-1">Pesanan</span>
        </a>
        <a href="{{ route('dropshipper.cart') }}" class="flex flex-col items-center justify-center relative text-gray-500 hover:text-primary">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold w-4 h-4 flex items-center justify-center rounded-full">
                {{ session('cart') ? count(session('cart')) : 0 }}
            </span>
            <span class="text-[10px] mt-1">Cart</span>
        </a>
    </div>

</body>
</html>