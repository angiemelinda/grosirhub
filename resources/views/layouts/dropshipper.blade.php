<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GrosirHub Dropshipper')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: '#f97316', 'primary-dark': '#ea580c', 'primary-light': '#fed7aa' },
                    fontFamily: { 'display': ['Outfit', 'sans-serif'], 'body': ['DM Sans', 'sans-serif'] }
                }
            }
        }
    </script>
    <style> body { font-family: 'DM Sans', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-900 font-body flex flex-col min-h-screen">

    <nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0">
                    <a href="{{ route('dropshipper.dashboard') }}" class="text-2xl font-bold text-primary font-display">GrosirHub</a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('dropshipper.dashboard') }}" class="text-sm font-medium hover:text-primary {{ request()->routeIs('dropshipper.dashboard') ? 'text-primary' : 'text-gray-600' }}">Beranda</a>
                    <a href="{{ route('dropshipper.catalog') }}" class="text-sm font-medium hover:text-primary {{ request()->routeIs('dropshipper.catalog') ? 'text-primary' : 'text-gray-600' }}">Produk</a>
                    <a href="{{ route('dropshipper.orders') }}" class="text-sm font-medium hover:text-primary {{ request()->routeIs('dropshipper.orders') ? 'text-primary' : 'text-gray-600' }}">Pesanan</a>
                    <a href="{{ route('dropshipper.order-history') }}" class="text-sm font-medium hover:text-primary {{ request()->routeIs('dropshipper.order-history') ? 'text-primary' : 'text-gray-600' }}">Riwayat</a>
                </div>

                <div class="flex items-center space-x-5">
                    <form action="{{ route('dropshipper.catalog') }}" method="GET" class="hidden md:block">
                        <input type="text" name="search" placeholder="Cari produk..." class="bg-gray-100 border-none rounded-full px-4 py-1.5 text-sm focus:ring-2 focus:ring-primary w-48">
                    </form>

                    <a href="{{ route('dropshipper.cart') }}" class="relative text-gray-600 hover:text-primary">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>

                    <div class="relative group">
                        <button class="w-8 h-8 rounded-full bg-primary text-white font-bold flex items-center justify-center text-sm">
                            {{ substr(Auth::user()->name ?? 'U', 0, 2) }}
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 hidden group-hover:block border border-gray-100">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name ?? 'User' }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email ?? '' }}</p>
                            </div>
                            <a href="{{ route('dropshipper.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-primary">Edit Profil</a>
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-200 mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} GrosirHub. Platform Dropship Terpercaya.
        </div>
    </footer>

</body>
</html>