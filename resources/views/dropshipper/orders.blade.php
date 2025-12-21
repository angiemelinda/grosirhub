<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - GrosirHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
        body {
            font-family: 'DM Sans', sans-serif;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }

        /* Animations */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-down {
            animation: slideDown 0.3s ease-out;
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.4s ease-out;
        }

        /* Status badge animations */
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        .badge-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Table row hover effect */
        .order-row {
            transition: all 0.2s ease;
        }

        .order-row:hover {
            background-color: #fff7ed;
            transform: translateX(4px);
        }

        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Smooth transitions */
        * {
            transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }

        /* Tab active indicator */
        .tab-active {
            position: relative;
        }

        .tab-active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(to right, #f97316, #ea580c);
            border-radius: 2px 2px 0 0;
        }

        /* Expandable row animation */
        .expand-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .expand-content.active {
            max-height: 500px;
        }

        /* Status indicator glow */
        .status-glow {
            box-shadow: 0 0 20px rgba(249, 115, 22, 0.3);
        }

        /* Card stagger animation */
        .order-card:nth-child(1) { animation-delay: 0s; }
        .order-card:nth-child(2) { animation-delay: 0.05s; }
        .order-card:nth-child(3) { animation-delay: 0.1s; }
        .order-card:nth-child(4) { animation-delay: 0.15s; }
        .order-card:nth-child(5) { animation-delay: 0.2s; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Top Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="index.html" class="text-2xl font-bold text-primary font-display">GrosirHub</a>
                </div>

                <!-- Navigation Menu -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('dropshipper.dashboard') }}" class="text-gray-700 hover:text-primary font-medium {{ request()->routeIs('dropshipper.dashboard') ? 'text-primary font-semibold border-b-2 border-primary pb-1' : '' }}">Beranda</a>
                    <a href="{{ route('dropshipper.catalog') }}" class="text-gray-700 hover:text-primary font-medium {{ request()->routeIs('dropshipper.catalog') ? 'text-primary font-semibold border-b-2 border-primary pb-1' : '' }}">Produk</a>
                    <a href="{{ route('dropshipper.orders') }}" class="{{ request()->routeIs('dropshipper.orders') ? 'text-primary font-semibold border-b-2 border-primary pb-1' : 'text-gray-700 hover:text-primary' }} font-medium">Pesanan</a>
                    <a href="{{ route('dropshipper.order-history') }}" class="text-gray-700 hover:text-primary font-medium {{ request()->routeIs('dropshipper.order-history') ? 'text-primary font-semibold border-b-2 border-primary pb-1' : '' }}">Riwayat</a>
                </div>

                <!-- Right Section -->
                <div class="flex items-center space-x-4">
                    <!-- Search Bar -->
                    <div class="hidden md:block w-64">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Cari pesanan...">
                        </div>
                    </div>

                    <!-- Icons -->
                    <div class="flex items-center space-x-4">
                        <a href="#" class="text-gray-700 hover:text-primary relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span class="absolute -top-2 -right-2 bg-primary text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-semibold">3</span>
                        </a>
                        <div class="relative group">
                            <button class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-semibold cursor-pointer">
                                JD
                            </button>
                            <div class="hidden group-hover:block absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50 animate-slide-down">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profil Saya</a>
                                <a href="{{ route('dropshipper.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Pengaturan Akun</a>
                                <hr class="my-1">
                                <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8 mb-20 md:mb-0">
        <!-- Page Header -->
        <div class="mb-8 animate-fade-in">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2 font-display">Pesanan Saya</h1>
            <p class="text-gray-600">Pantau status pesanan dan pengiriman Anda secara real-time</p>
        </div>

        <!-- Order Status Summary Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8 animate-slide-up">
            <div class="bg-gradient-to-br from-yellow-50 to-orange-50 p-5 rounded-xl border-2 border-yellow-200 hover:shadow-lg transition cursor-pointer">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-yellow-600 font-display">2</div>
                    </div>
                </div>
                <div class="font-semibold text-gray-800 mb-1">Belum Bayar</div>
                <div class="text-xs text-gray-600">Selesaikan pembayaran</div>
            </div>

            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-5 rounded-xl border-2 border-blue-200 hover:shadow-lg transition cursor-pointer">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-blue-600 font-display">5</div>
                    </div>
                </div>
                <div class="font-semibold text-gray-800 mb-1">Dikemas</div>
                <div class="text-xs text-gray-600">Pesanan disiapkan</div>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-5 rounded-xl border-2 border-purple-200 hover:shadow-lg transition cursor-pointer">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center badge-pulse">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-purple-600 font-display">8</div>
                    </div>
                </div>
                <div class="font-semibold text-gray-800 mb-1">Dikirim</div>
                <div class="text-xs text-gray-600">Dalam pengiriman</div>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-5 rounded-xl border-2 border-green-200 hover:shadow-lg transition cursor-pointer">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-green-600 font-display">127</div>
                    </div>
                </div>
                <div class="font-semibold text-gray-800 mb-1">Selesai</div>
                <div class="text-xs text-gray-600">Pesanan diterima</div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="bg-white rounded-xl shadow-sm p-1 mb-6 animate-fade-in">
            <div class="flex items-center overflow-x-auto custom-scrollbar">
                <button class="tab-active flex-shrink-0 px-6 py-3 text-sm font-semibold text-primary rounded-lg">
                    Semua (142)
                </button>
                <button class="flex-shrink-0 px-6 py-3 text-sm font-medium text-gray-600 hover:text-primary hover:bg-gray-50 rounded-lg">
                    Belum Bayar (2)
                </button>
                <button class="flex-shrink-0 px-6 py-3 text-sm font-medium text-gray-600 hover:text-primary hover:bg-gray-50 rounded-lg">
                    Dikemas (5)
                </button>
                <button class="flex-shrink-0 px-6 py-3 text-sm font-medium text-gray-600 hover:text-primary hover:bg-gray-50 rounded-lg">
                    Dikirim (8)
                </button>
                <button class="flex-shrink-0 px-6 py-3 text-sm font-medium text-gray-600 hover:text-primary hover:bg-gray-50 rounded-lg">
                    Selesai (127)
                </button>
            </div>
        </div>

        <!-- Orders Table - Desktop View -->
        <div class="hidden md:block bg-white rounded-xl shadow-sm overflow-hidden animate-slide-up">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-orange-50 to-amber-50 border-b-2 border-orange-200">
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Pesanan
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Produk
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Total Bayar
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Status Pembayaran
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Status Pengiriman
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Order Row 1 - Belum Bayar -->
                        <tr class="order-row hover:bg-orange-50">
                            <td class="px-6 py-5">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-100 to-orange-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900 mb-1">#ORD-2024-001</div>
                                        <div class="text-sm text-gray-600">15 Des 2024, 14:30</div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            <span class="inline-flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Jakarta Selatan
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center space-x-3">
                                    <div class="w-14 h-14 bg-gradient-to-br from-orange-100 to-pink-100 rounded-lg flex-shrink-0"></div>
                                    <div>
                                        <div class="font-medium text-gray-900 mb-1">Kaos Polos Premium</div>
                                        <div class="text-sm text-gray-600">50 pcs × Rp 29.000</div>
                                        <div class="text-xs text-gray-500 mt-1">+ 2 produk lainnya</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="font-bold text-lg text-gray-900">Rp 1.850.000</div>
                                <div class="text-xs text-gray-500">Termasuk ongkir</div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-700 border border-yellow-300">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                    Menunggu Pembayaran
                                </span>
                                <div class="text-xs text-red-600 mt-2 font-medium">
                                    Bayar sebelum 23:59 WIB
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-600">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                    Menunggu Pembayaran
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <button class="w-full px-4 py-2.5 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark mb-2 flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Bayar Sekarang
                                </button>
                                <button class="w-full px-4 py-2 text-gray-600 hover:text-primary text-sm font-medium flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>

                        <!-- Order Row 2 - Dikemas -->
                        <tr class="order-row hover:bg-orange-50">
                            <td class="px-6 py-5">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900 mb-1">#ORD-2024-002</div>
                                        <div class="text-sm text-gray-600">14 Des 2024, 10:15</div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            <span class="inline-flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Bandung
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center space-x-3">
                                    <div class="w-14 h-14 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-lg flex-shrink-0"></div>
                                    <div>
                                        <div class="font-medium text-gray-900 mb-1">Totebag Canvas</div>
                                        <div class="text-sm text-gray-600">100 pcs × Rp 21.000</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="font-bold text-lg text-gray-900">Rp 2.150.000</div>
                                <div class="text-xs text-gray-500">Termasuk ongkir</div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-green-100 text-green-700 border border-green-300">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Sudah Dibayar
                                </span>
                                <div class="text-xs text-gray-600 mt-2">
                                    Transfer Bank • BCA
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-blue-100 text-blue-700 border border-blue-300">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path>
                                    </svg>
                                    Sedang Dikemas
                                </span>
                                <div class="text-xs text-gray-600 mt-2">
                                    Estimasi kirim: 16 Des
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <button class="w-full px-4 py-2.5 bg-white border-2 border-primary text-primary rounded-lg font-semibold hover:bg-primary hover:text-white mb-2">
                                    Hubungi Penjual
                                </button>
                                <button class="w-full px-4 py-2 text-gray-600 hover:text-primary text-sm font-medium flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>

                        <!-- Order Row 3 - Dikirim -->
                        <tr class="order-row hover:bg-orange-50">
                            <td class="px-6 py-5">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex items-center justify-center status-glow">
                                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900 mb-1">#ORD-2024-003</div>
                                        <div class="text-sm text-gray-600">12 Des 2024, 16:45</div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            <span class="inline-flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Surabaya
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center space-x-3">
                                    <div class="w-14 h-14 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex-shrink-0"></div>
                                    <div>
                                        <div class="font-medium text-gray-900 mb-1">Powerbank 10000mAh</div>
                                        <div class="text-sm text-gray-600">30 pcs × Rp 60.000</div>
                                        <div class="text-xs text-gray-500 mt-1">+ 1 produk lainnya</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="font-bold text-lg text-gray-900">Rp 2.450.000</div>
                                <div class="text-xs text-gray-500">Termasuk ongkir</div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-green-100 text-green-700 border border-green-300">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Sudah Dibayar
                                </span>
                                <div class="text-xs text-gray-600 mt-2">
                                    E-Wallet • GoPay
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-purple-100 text-purple-700 border border-purple-300 badge-pulse">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path>
                                    </svg>
                                    Dalam Pengiriman
                                </span>
                                <div class="text-xs font-medium text-purple-700 mt-2">
                                    JNE REG • JNEX0012345678
                                </div>
                                <div class="text-xs text-gray-600">
                                    Estimasi tiba: 16 Des
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <button class="w-full px-4 py-2.5 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark mb-2 flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Lacak Paket
                                </button>
                                <button class="w-full px-4 py-2 text-gray-600 hover:text-primary text-sm font-medium flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>

                        <!-- Order Row 4 - Selesai -->
                        <tr class="order-row hover:bg-orange-50">
                            <td class="px-6 py-5">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-emerald-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900 mb-1">#ORD-2024-004</div>
                                        <div class="text-sm text-gray-600">10 Des 2024, 09:20</div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            <span class="inline-flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Semarang
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center space-x-3">
                                    <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-emerald-100 rounded-lg flex-shrink-0"></div>
                                    <div>
                                        <div class="font-medium text-gray-900 mb-1">Serum Wajah Vitamin C</div>
                                        <div class="text-sm text-gray-600">24 pcs × Rp 38.500</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="font-bold text-lg text-gray-900">Rp 974.000</div>
                                <div class="text-xs text-gray-500">Termasuk ongkir</div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-green-100 text-green-700 border border-green-300">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Sudah Dibayar
                                </span>
                                <div class="text-xs text-gray-600 mt-2">
                                    Transfer Bank • Mandiri
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-green-100 text-green-700 border border-green-300">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Pesanan Selesai
                                </span>
                                <div class="text-xs text-gray-600 mt-2">
                                    Diterima: 14 Des 2024
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <button class="w-full px-4 py-2.5 bg-white border-2 border-primary text-primary rounded-lg font-semibold hover:bg-primary hover:text-white mb-2">
                                    Beli Lagi
                                </button>
                                <button class="w-full px-4 py-2 text-gray-600 hover:text-primary text-sm font-medium flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Orders List - Mobile View -->
        <div class="md:hidden space-y-4">
            <!-- Order Card 1 -->
            <div class="order-card bg-white rounded-xl shadow-sm p-4 animate-slide-up">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-start space-x-3 flex-1">
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-100 to-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-bold text-gray-900">#ORD-2024-001</div>
                            <div class="text-sm text-gray-600">15 Des 2024, 14:30</div>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700 mt-2">
                                Belum Bayar
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-3 mb-4 pb-4 border-b border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-100 to-pink-100 rounded-lg flex-shrink-0"></div>
                    <div class="flex-1 min-w-0">
                        <div class="font-medium text-gray-900 truncate">Kaos Polos Premium</div>
                        <div class="text-sm text-gray-600">50 pcs × Rp 29.000</div>
                        <div class="text-xs text-gray-500">+ 2 produk lainnya</div>
                    </div>
                </div>
                <div class="flex items-center justify-between mb-4">
                    <div class="text-sm text-gray-600">Total Pembayaran</div>
                    <div class="font-bold text-lg text-gray-900">Rp 1.850.000</div>
                </div>
                <div class="flex gap-2">
                    <button class="flex-1 px-4 py-2.5 bg-primary text-white rounded-lg font-semibold text-sm">
                        Bayar Sekarang
                    </button>
                    <button class="px-4 py-2.5 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Order Card 2 -->
            <div class="order-card bg-white rounded-xl shadow-sm p-4 animate-slide-up">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-start space-x-3 flex-1">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-bold text-gray-900">#ORD-2024-002</div>
                            <div class="text-sm text-gray-600">14 Des 2024, 10:15</div>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 mt-2">
                                Dikemas
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-3 mb-4 pb-4 border-b border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-lg flex-shrink-0"></div>
                    <div class="flex-1 min-w-0">
                        <div class="font-medium text-gray-900 truncate">Totebag Canvas</div>
                        <div class="text-sm text-gray-600">100 pcs × Rp 21.000</div>
                    </div>
                </div>
                <div class="flex items-center justify-between mb-4">
                    <div class="text-sm text-gray-600">Total Pembayaran</div>
                    <div class="font-bold text-lg text-gray-900">Rp 2.150.000</div>
                </div>
                <div class="flex gap-2">
                    <button class="flex-1 px-4 py-2.5 bg-white border-2 border-primary text-primary rounded-lg font-semibold text-sm">
                        Hubungi Penjual
                    </button>
                    <button class="px-4 py-2.5 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Order Card 3 -->
            <div class="order-card bg-white rounded-xl shadow-sm p-4 animate-slide-up">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-start space-x-3 flex-1">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-bold text-gray-900">#ORD-2024-003</div>
                            <div class="text-sm text-gray-600">12 Des 2024, 16:45</div>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-700 mt-2 badge-pulse">
                                Dikirim
                            </span>
                        </div>
                    </div>
                </div>
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 mb-4">
                    <div class="text-xs font-semibold text-purple-700 mb-1">JNE REG • JNEX0012345678</div>
                    <div class="text-xs text-purple-600">Estimasi tiba: 16 Des 2024</div>
                </div>
                <div class="flex items-center space-x-3 mb-4 pb-4 border-b border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex-shrink-0"></div>
                    <div class="flex-1 min-w-0">
                        <div class="font-medium text-gray-900 truncate">Powerbank 10000mAh</div>
                        <div class="text-sm text-gray-600">30 pcs × Rp 60.000</div>
                        <div class="text-xs text-gray-500">+ 1 produk lainnya</div>
                    </div>
                </div>
                <div class="flex items-center justify-between mb-4">
                    <div class="text-sm text-gray-600">Total Pembayaran</div>
                    <div class="font-bold text-lg text-gray-900">Rp 2.450.000</div>
                </div>
                <div class="flex gap-2">
                    <button class="flex-1 px-4 py-2.5 bg-primary text-white rounded-lg font-semibold text-sm flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Lacak Paket
                    </button>
                    <button class="px-4 py-2.5 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between py-6 mt-6 border-t border-gray-200">
            <div class="text-sm text-gray-600">
                Menampilkan <span class="font-semibold">1-10</span> dari <span class="font-semibold">142</span> pesanan
            </div>
            <div class="flex items-center space-x-2">
                <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    Sebelumnya
                </button>
                <button class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-semibold">1</button>
                <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">2</button>
                <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">3</button>
                <span class="px-2 text-gray-500">...</span>
                <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">15</button>
                <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Selanjutnya
                </button>
            </div>
        </div>
    </main>

    <!-- Mobile Bottom Navigation -->
    <div class="md:hidden bg-white border-t border-gray-200 fixed bottom-0 left-0 right-0 z-50 shadow-lg">
        <div class="flex justify-around items-center h-16">
            <a href="{{ route('dropshipper.dashboard') }}" class="flex flex-col items-center justify-center {{ request()->routeIs('dropshipper.dashboard') ? 'text-primary' : 'text-gray-700 hover:text-primary' }} transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="text-xs mt-1">Beranda</span>
            </a>
            <a href="{{ route('dropshipper.catalog') }}" class="flex flex-col items-center justify-center {{ request()->routeIs('dropshipper.catalog') ? 'text-primary' : 'text-gray-700 hover:text-primary' }} transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                </svg>
                <span class="text-xs mt-1">Produk</span>
            </a>
            <a href="{{ route('dropshipper.orders') }}" class="flex flex-col items-center justify-center {{ request()->routeIs('dropshipper.orders') ? 'text-primary' : 'text-gray-700 hover:text-primary' }} transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <span class="text-xs mt-1 {{ request()->routeIs('dropshipper.orders') ? 'font-semibold' : '' }}">Pesanan</span>
            </a>
            <a href="{{ route('dropshipper.cart') }}" class="flex flex-col items-center justify-center text-gray-700 hover:text-primary transition relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span class="absolute -top-1 right-3 bg-primary text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-semibold">3</span>
                <span class="text-xs mt-1">Keranjang</span>
            </a>
        </div>
    </div>
</body>
</html>