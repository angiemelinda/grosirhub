<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Supplier Grosir Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#f97316',
                        'primary-dark': '#ea580c',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-inter min-h-screen flex">

<aside class="w-64 bg-white shadow-lg flex flex-col border-r">
    <div class="p-6 text-2xl font-bold text-orange-500 border-b">
        Grosir<span class="text-gray-800">Hub</span>
    </div>

    <div class="px-4 mt-6">
        <p class="text-xs font-semibold text-gray-400 uppercase mb-3">Menu Utama</p>
        <nav class="space-y-1">
            <a href="{{ route('supplier.dashboard') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                {{ request()->routeIs('supplier.dashboard') ? 'bg-orange-100 text-orange-600 border-l-4 border-orange-500' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5L12 3l9 7.5M5 10v10h5v-6h4v6h5V10"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('supplier.produk.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                {{ request()->routeIs('supplier.produk.*') ? 'bg-orange-100 text-orange-600 border-l-4 border-orange-500' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    <path d="M3.3 7L12 12l8.7-5M12 22V12"/>
                </svg>
                Produk
            </a>

            <a href="{{ route('supplier.order.masuk') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                {{ request()->routeIs('supplier.order.masuk') ? 'bg-orange-100 text-orange-600 border-l-4 border-orange-500' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                Order Masuk
            </a>

            <a href="{{ route('supplier.pengiriman') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                {{ request()->routeIs('supplier.pengiriman') ? 'bg-orange-100 text-orange-600 border-l-4 border-orange-500' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5 18h14M5 18a2 2 0 00-2 2h18a2 2 0 00-2-2M5 18V9h3l2-5h6l2 5h3v9M7 14h10"/>
                </svg>
                Pengiriman
            </a>

            <a href="{{ route('supplier.riwayat') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                {{ request()->routeIs('supplier.riwayat') ? 'bg-orange-100 text-orange-600 border-l-4 border-orange-500' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Riwayat Transaksi
            </a>

            <a href="{{ route('supplier.earnings') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                {{ request()->routeIs('supplier.earnings') ? 'bg-orange-100 text-orange-600 border-l-4 border-orange-500' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Pendapatan
            </a>
        </nav>

        <div class="my-6 border-t"></div>

        <p class="text-xs font-semibold text-gray-400 uppercase mt-8 mb-3">Pengaturan</p>
        <nav class="space-y-1">
            <a href="{{ route('supplier.profil.edit') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                {{ request()->routeIs('supplier.profil.*') ? 'bg-orange-100 text-orange-600 border-l-4 border-orange-500' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Profil
            </a>

            <a href="{{ route('supplier.pengaturan') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                {{ request()->routeIs('supplier.pengaturan') ? 'bg-orange-100 text-orange-600 border-l-4 border-orange-500' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.591 1.066 1.724 1.724 0 012.356 2.356 1.724 1.724 0 001.066 2.591c1.756.426 1.756 2.924 0 3.35 a1.724 1.724 0 00-1.066 2.591 1.724 1.724 0 01-2.356 2.356 1.724 1.724 0 00-2.591 1.066c-.426 1.756-2.924 1.756-3.35 0 a1.724 1.724 0 00-2.591-1.066 1.724 1.724 0 01-2.356-2.356 1.724 1.724 0 00-1.066-2.591c-1.756-.426-1.756-2.924 0-3.35 a1.724 1.724 0 001.066-2.591 1.724 1.724 0 012.356-2.356 1.724 1.724 0 002.591-1.066z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Pengaturan
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-red-500 hover:bg-red-50 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </nav>
    </div>
</aside>

<main class="flex-1 p-6 max-w-7xl mx-auto space-y-6">

    <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6">
        <div class="text-gray-800 font-semibold text-lg">
            Hi, {{ Auth::user()->name }}
        </div>

        @if(request()->routeIs('supplier.produk.*'))
        <form action="{{ route('supplier.produk.index') }}" method="GET" class="flex-1 max-w-md">
            <div class="relative flex items-center">
                <svg class="w-5 h-5 absolute left-3 text-gray-400" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35m0 0a7 7 0 10-9.9-9.9 7 7 0 009.9 9.9z"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari produk..."
                    class="w-full pl-10 p-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-400 focus:outline-none">
            </div>
        </form>
        @endif

        <div class="flex items-center gap-3">
            <button class="p-2 rounded-lg bg-yellow-400 text-white hover:bg-yellow-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" 
                    viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            </button>
        </div>
    </div>

    {{-- Konten halaman --}}
    @yield('content')
</main>
</body>
</html>