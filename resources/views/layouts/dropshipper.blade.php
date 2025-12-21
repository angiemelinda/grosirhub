<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GrosirHub')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-white text-gray-900 min-h-screen font-inter">
    <div class="min-h-screen flex flex-col">
        <header class="sticky top-0 z-40 border-b border-gray-200 px-6 py-3 bg-white">
            <div class="relative flex items-center justify-between">
                <div class="flex items-center">
                    <a href="{{ route('dropshipper.dashboard') }}" class="text-xl font-semibold text-gray-900">GrosirHub</a>
                </div>
                <nav class="absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 flex items-center gap-6">
                        <a href="{{ route('dropshipper.dashboard') }}" class="pb-2 flex items-center gap-2 {{ request()->routeIs('dropshipper.dashboard') ? 'text-orange-600 border-b-2 border-orange-600' : 'text-gray-700 hover:text-orange-600' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3l9 8h-3v9H6v-9H3z"/></svg>
                            <span>Beranda</span>
                        </a>
                        <a href="{{ route('dropshipper.catalog') }}" class="pb-2 flex items-center gap-2 {{ request()->routeIs('dropshipper.catalog') ? 'text-orange-600 border-b-2 border-orange-600' : 'text-gray-700 hover:text-orange-600' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M4 6h16v4H4zM4 12h16v6H4z"/></svg>
                            <span>Produk</span>
                        </a>
                        <a href="{{ route('dropshipper.orders') }}" class="pb-2 flex items-center gap-2 {{ request()->routeIs('dropshipper.orders') ? 'text-orange-600 border-b-2 border-orange-600' : 'text-gray-700 hover:text-orange-600' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 3h2l.4 2H21l-2 9H7l-2-9H3zM7 18a2 2 0 104 0 2 2 0 00-4 0zm8 0a2 2 0 104 0 2 2 0 00-4 0z"/></svg>
                            <span>Pesanan</span>
                        </a>
                        <a href="{{ route('dropshipper.order-history') }}" class="pb-2 flex items-center gap-2 {{ request()->routeIs('dropshipper.order-history') ? 'text-orange-600 border-b-2 border-orange-600' : 'text-gray-700 hover:text-orange-600' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M13 3a9 9 0 109 9h-2a7 7 0 11-7-7V3zm1 5h-2v5l4 2 .9-1.8-2.9-1.2V8z"/></svg>
                            <span>Riwayat</span>
                        </a>
                        <a href="{{ route('dropshipper.profile') }}" class="pb-2 flex items-center gap-2 {{ request()->routeIs('dropshipper.profile') ? 'text-orange-600 border-b-2 border-orange-600' : 'text-gray-700 hover:text-orange-600' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-4 0-8 2-8 5v3h16v-3c0-3-4-5-8-5z"/></svg>
                            <span>Profil</span>
                        </a>
                </nav>
                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('dropshipper.cart') }}" class="relative p-2 rounded-lg hover:bg-gray-100" title="Keranjang">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m12-9l2 9M9 21h6"/>
                        </svg>
                        <span id="cart-count" class="absolute -top-1 -right-1 text-xs px-1.5 py-0.5 rounded-full bg-orange-500 text-white hidden"></span>
                    </a>
                    <button class="p-2 rounded-lg hover:bg-gray-100" title="Notifikasi">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22a2 2 0 002-2H10a2 2 0 002 2zm6-6V9a6 6 0 10-12 0v7l-2 2h16l-2-2z"/></svg>
                    </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="px-4 py-2 rounded-lg bg-orange-500 text-white hover:bg-orange-600">Logout</button>
                    </form>
                </div>
            </div>
        </header>
        <main class="p-6">
            @yield('content')
            <div id="gh-toast" class="fixed bottom-6 left-1/2 -translate-x-1/2 -translate-y-4 opacity-0 transition-all duration-300 bg-gray-900 text-white text-sm px-4 py-2 rounded-lg shadow">Produk ditambahkan ke keranjang</div>
        </main>
        @stack('scripts')
    </div>
</body>
</html>
