<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - GrosirHub</title>
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

        /* Custom Animations */
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

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-slide-down {
            animation: slideDown 0.3s ease-out;
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease-out;
        }

        .animate-scale-in {
            animation: scaleIn 0.3s ease-out;
        }

        /* Product Card Hover Effects */
        .product-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .product-card:hover {
            transform: translateY(-4px);
        }

        .product-image {
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        /* Filter Checkbox Style */
        .filter-checkbox:checked {
            background-color: #f97316;
            border-color: #f97316;
        }

        /* Price Range Slider */
        input[type="range"] {
            -webkit-appearance: none;
            appearance: none;
            background: transparent;
            cursor: pointer;
        }

        input[type="range"]::-webkit-slider-track {
            background-color: #fed7aa;
            height: 6px;
            border-radius: 3px;
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            background-color: #f97316;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(249, 115, 22, 0.4);
            margin-top: -7px;
        }

        input[type="range"]::-moz-range-track {
            background-color: #fed7aa;
            height: 6px;
            border-radius: 3px;
        }

        input[type="range"]::-moz-range-thumb {
            background-color: #f97316;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(249, 115, 22, 0.4);
        }

        /* Scrollbar Styling */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
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

        /* Badge pulse animation */
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

        /* Grid stagger animation */
        .product-card:nth-child(1) { animation-delay: 0s; }
        .product-card:nth-child(2) { animation-delay: 0.05s; }
        .product-card:nth-child(3) { animation-delay: 0.1s; }
        .product-card:nth-child(4) { animation-delay: 0.15s; }
        .product-card:nth-child(5) { animation-delay: 0.2s; }
        .product-card:nth-child(6) { animation-delay: 0.25s; }
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
                    <a href="{{ route('dropshipper.catalog') }}" class="{{ request()->routeIs('dropshipper.catalog') ? 'text-primary font-semibold border-b-2 border-primary pb-1' : 'text-gray-700 hover:text-primary' }} font-medium">Produk</a>
                    <a href="{{ route('dropshipper.orders') }}" class="text-gray-700 hover:text-primary font-medium {{ request()->routeIs('dropshipper.orders') ? 'text-primary font-semibold border-b-2 border-primary pb-1' : '' }}">Pesanan</a>
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
                            <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Cari produk...">
                        </div>
                    </div>

                    <!-- Icons -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('dropshipper.cart') }}" class="text-gray-700 hover:text-primary relative">
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
                                <a href="{{ route('dropshipper.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profil Saya</a>
                                <a href="{{ route('dropshipper.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Pengaturan Akun</a>
                                <hr class="my-1">
                                <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Search Bar -->
        <div class="md:hidden px-4 pb-4">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Cari produk...">
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8 mb-20 md:mb-0">
        <!-- Breadcrumb -->
        <div class="flex items-center space-x-2 text-sm text-gray-600 mb-6">
            <a href="index.html" class="hover:text-primary">Beranda</a>
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-primary font-medium">Katalog Produk</span>
        </div>

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3 font-display">Katalog Produk</h1>
            <p class="text-gray-600 text-lg">Temukan produk grosir terbaik dengan harga kompetitif</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Sidebar Filters -->
            <aside class="w-full lg:w-64 flex-shrink-0">
                <div class="bg-white rounded-xl shadow-sm p-6 sticky top-20">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-lg text-gray-900 font-display">Filter</h3>
                        <button class="text-primary text-sm font-medium hover:text-primary-dark">Reset</button>
                    </div>

                    <!-- Category Filter -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-900 mb-3 font-display">Kategori</h4>
                        <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                            <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                <input type="checkbox" class="filter-checkbox w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary mr-3">
                                <span class="text-gray-700 text-sm">Fashion & Pakaian</span>
                                <span class="ml-auto text-xs text-gray-400">(234)</span>
                            </label>
                            <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                <input type="checkbox" class="filter-checkbox w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary mr-3">
                                <span class="text-gray-700 text-sm">Elektronik</span>
                                <span class="ml-auto text-xs text-gray-400">(189)</span>
                            </label>
                            <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                <input type="checkbox" class="filter-checkbox w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary mr-3">
                                <span class="text-gray-700 text-sm">Kecantikan & Kesehatan</span>
                                <span class="ml-auto text-xs text-gray-400">(156)</span>
                            </label>
                            <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                <input type="checkbox" class="filter-checkbox w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary mr-3">
                                <span class="text-gray-700 text-sm">Aksesoris</span>
                                <span class="ml-auto text-xs text-gray-400">(142)</span>
                            </label>
                            <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                <input type="checkbox" class="filter-checkbox w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary mr-3">
                                <span class="text-gray-700 text-sm">Peralatan Rumah</span>
                                <span class="ml-auto text-xs text-gray-400">(98)</span>
                            </label>
                            <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                <input type="checkbox" class="filter-checkbox w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary mr-3">
                                <span class="text-gray-700 text-sm">Olahraga & Outdoor</span>
                                <span class="ml-auto text-xs text-gray-400">(87)</span>
                            </label>
                            <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                <input type="checkbox" class="filter-checkbox w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary mr-3">
                                <span class="text-gray-700 text-sm">Mainan & Hobi</span>
                                <span class="ml-auto text-xs text-gray-400">(76)</span>
                            </label>
                        </div>
                    </div>

                    <hr class="my-6 border-gray-200">

                    <!-- Price Range Filter -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-900 mb-3 font-display">Rentang Harga</h4>
                        <div class="space-y-4">
                            <div>
                                <input type="range" min="0" max="500000" value="250000" class="w-full">
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-sm font-medium text-gray-700">Rp 0</span>
                                    <span class="text-sm font-medium text-primary">Rp 500.000+</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="number" placeholder="Min" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                <span class="text-gray-400">-</span>
                                <input type="number" placeholder="Max" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <hr class="my-6 border-gray-200">

                    <!-- Minimum Order Filter -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-900 mb-3 font-display">Minimum Order</h4>
                        <div class="space-y-2">
                            <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                <input type="checkbox" class="filter-checkbox w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary mr-3">
                                <span class="text-gray-700 text-sm">1-10 pcs</span>
                            </label>
                            <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                <input type="checkbox" class="filter-checkbox w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary mr-3">
                                <span class="text-gray-700 text-sm">11-50 pcs</span>
                            </label>
                            <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                <input type="checkbox" class="filter-checkbox w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary mr-3">
                                <span class="text-gray-700 text-sm">51-100 pcs</span>
                            </label>
                            <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                <input type="checkbox" class="filter-checkbox w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary mr-3">
                                <span class="text-gray-700 text-sm">100+ pcs</span>
                            </label>
                        </div>
                    </div>

                    <hr class="my-6 border-gray-200">

                    <!-- Rating Filter -->
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-3 font-display">Rating Supplier</h4>
                        <div class="space-y-2">
                            <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                <input type="checkbox" class="filter-checkbox w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary mr-3">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                    <span class="ml-2 text-gray-700 text-sm">4.5+ Bintang</span>
                                </div>
                            </label>
                            <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                <input type="checkbox" class="filter-checkbox w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary mr-3">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                    <span class="ml-2 text-gray-700 text-sm">4.0+ Bintang</span>
                                </div>
                            </label>
                            <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                <input type="checkbox" class="filter-checkbox w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary mr-3">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                    <span class="ml-2 text-gray-700 text-sm">3.5+ Bintang</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Products Grid -->
            <div class="flex-1">
                <!-- Sort & View Options -->
                <div class="bg-white rounded-xl shadow-sm p-4 mb-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-600 text-sm">Menampilkan</span>
                        <span class="font-bold text-gray-900">1,234</span>
                        <span class="text-gray-600 text-sm">produk</span>
                    </div>
                    
                    <div class="flex items-center space-x-4 w-full md:w-auto">
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-600 text-sm">Urutkan:</span>
                            <select class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent cursor-pointer">
                                <option>Terpopuler</option>
                                <option>Harga Terendah</option>
                                <option>Harga Tertinggi</option>
                                <option>Terbaru</option>
                                <option>Rating Tertinggi</option>
                            </select>
                        </div>
                        <div class="hidden md:flex items-center space-x-2">
                            <button class="p-2 border border-gray-300 rounded-lg hover:border-primary hover:text-primary">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                            </button>
                            <button class="p-2 border border-primary bg-primary/5 text-primary rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Active Filters -->
                <div class="flex flex-wrap items-center gap-2 mb-6">
                    <span class="text-sm text-gray-600">Filter Aktif:</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-primary/10 text-primary border border-primary/20">
                        Fashion & Pakaian
                        <button class="ml-2 hover:text-primary-dark">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-primary/10 text-primary border border-primary/20">
                        4.5+ Bintang
                        <button class="ml-2 hover:text-primary-dark">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </span>
                </div>

                <!-- Product Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
                    <!-- Product Card 1 -->
                    <div class="product-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl cursor-pointer group animate-scale-in">
                        <div class="relative overflow-hidden">
                            <div class="product-image aspect-square bg-gradient-to-br from-orange-50 via-pink-50 to-purple-50"></div>
                            <div class="absolute top-2 left-2 flex flex-col gap-1">
                                <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded shadow-lg">-35%</span>
                                <span class="bg-blue-500 text-white text-xs font-semibold px-2 py-1 rounded shadow-lg badge-pulse">Terlaris</span>
                            </div>
                            <button class="absolute top-2 right-2 w-9 h-9 bg-white/90 backdrop-blur rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow-lg hover:bg-white hover:scale-110">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center gap-1 mb-2">
                                <svg class="w-3.5 h-3.5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">4.8</span>
                                <span class="text-xs text-gray-400">• 2.3k terjual</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 text-sm mb-2 line-clamp-2 leading-snug">Kaos Polos Premium Cotton Combed 30s Unisex</h4>
                            <div class="mb-3">
                                <div class="text-xs text-gray-400 line-through">Rp 45.000</div>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-xl font-bold text-primary font-display">29K</span>
                                    <span class="text-xs text-gray-500">/pcs</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded-full">
                                    Min. 20 pcs
                                </div>
                                <div class="text-xs font-medium text-green-600 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                    </svg>
                                    Stok ready
                                </div>
                            </div>
                            <button class="w-full bg-primary text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-primary-dark transition flex items-center justify-center gap-2 shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </div>

                    <!-- Product Card 2 -->
                    <div class="product-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl cursor-pointer group animate-scale-in">
                        <div class="relative overflow-hidden">
                            <div class="product-image aspect-square bg-gradient-to-br from-blue-50 via-cyan-50 to-teal-50"></div>
                            <div class="absolute top-2 left-2">
                                <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded shadow-lg">-40%</span>
                            </div>
                            <button class="absolute top-2 right-2 w-9 h-9 bg-white/90 backdrop-blur rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow-lg hover:bg-white hover:scale-110">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center gap-1 mb-2">
                                <svg class="w-3.5 h-3.5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">4.9</span>
                                <span class="text-xs text-gray-400">• 1.8k terjual</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 text-sm mb-2 line-clamp-2 leading-snug">Totebag Canvas Premium Printing Custom Logo</h4>
                            <div class="mb-3">
                                <div class="text-xs text-gray-400 line-through">Rp 35.000</div>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-xl font-bold text-primary font-display">21K</span>
                                    <span class="text-xs text-gray-500">/pcs</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded-full">
                                    Min. 50 pcs
                                </div>
                                <div class="text-xs font-medium text-green-600 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                    </svg>
                                    Stok ready
                                </div>
                            </div>
                            <button class="w-full bg-primary text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-primary-dark transition flex items-center justify-center gap-2 shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </div>

                    <!-- Product Card 3 -->
                    <div class="product-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl cursor-pointer group animate-scale-in">
                        <div class="relative overflow-hidden">
                            <div class="product-image aspect-square bg-gradient-to-br from-purple-50 via-pink-50 to-rose-50"></div>
                            <div class="absolute top-2 left-2">
                                <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded shadow-lg">-25%</span>
                            </div>
                            <button class="absolute top-2 right-2 w-9 h-9 bg-white/90 backdrop-blur rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow-lg hover:bg-white hover:scale-110">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center gap-1 mb-2">
                                <svg class="w-3.5 h-3.5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">4.7</span>
                                <span class="text-xs text-gray-400">• 956 terjual</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 text-sm mb-2 line-clamp-2 leading-snug">Powerbank 10000mAh Fast Charging Type-C PD</h4>
                            <div class="mb-3">
                                <div class="text-xs text-gray-400 line-through">Rp 80.000</div>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-xl font-bold text-primary font-display">60K</span>
                                    <span class="text-xs text-gray-500">/pcs</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded-full">
                                    Min. 10 pcs
                                </div>
                                <div class="text-xs font-medium text-green-600 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                    </svg>
                                    Stok ready
                                </div>
                            </div>
                            <button class="w-full bg-primary text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-primary-dark transition flex items-center justify-center gap-2 shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </div>

                    <!-- Product Card 4 -->
                    <div class="product-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl cursor-pointer group animate-scale-in">
                        <div class="relative overflow-hidden">
                            <div class="product-image aspect-square bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50"></div>
                            <div class="absolute top-2 left-2 flex flex-col gap-1">
                                <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded shadow-lg">-30%</span>
                                <span class="bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded shadow-lg">Baru</span>
                            </div>
                            <button class="absolute top-2 right-2 w-9 h-9 bg-white/90 backdrop-blur rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow-lg hover:bg-white hover:scale-110">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center gap-1 mb-2">
                                <svg class="w-3.5 h-3.5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">4.9</span>
                                <span class="text-xs text-gray-400">• 742 terjual</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 text-sm mb-2 line-clamp-2 leading-snug">Serum Wajah Vitamin C + Hyaluronic Acid 30ml</h4>
                            <div class="mb-3">
                                <div class="text-xs text-gray-400 line-through">Rp 55.000</div>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-xl font-bold text-primary font-display">38.5K</span>
                                    <span class="text-xs text-gray-500">/pcs</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded-full">
                                    Min. 12 pcs
                                </div>
                                <div class="text-xs font-medium text-green-600 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                    </svg>
                                    Stok ready
                                </div>
                            </div>
                            <button class="w-full bg-primary text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-primary-dark transition flex items-center justify-center gap-2 shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </div>

                    <!-- Product Card 5 -->
                    <div class="product-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl cursor-pointer group animate-scale-in">
                        <div class="relative overflow-hidden">
                            <div class="product-image aspect-square bg-gradient-to-br from-amber-50 via-yellow-50 to-orange-50"></div>
                            <div class="absolute top-2 left-2">
                                <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded shadow-lg">-45%</span>
                            </div>
                            <button class="absolute top-2 right-2 w-9 h-9 bg-white/90 backdrop-blur rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow-lg hover:bg-white hover:scale-110">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center gap-1 mb-2">
                                <svg class="w-3.5 h-3.5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">4.6</span>
                                <span class="text-xs text-gray-400">• 1.2k terjual</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 text-sm mb-2 line-clamp-2 leading-snug">Jam Tangan Fashion Stainless Steel Analog Unisex</h4>
                            <div class="mb-3">
                                <div class="text-xs text-gray-400 line-through">Rp 120.000</div>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-xl font-bold text-primary font-display">66K</span>
                                    <span class="text-xs text-gray-500">/pcs</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded-full">
                                    Min. 5 pcs
                                </div>
                                <div class="text-xs font-medium text-green-600 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                    </svg>
                                    Stok ready
                                </div>
                            </div>
                            <button class="w-full bg-primary text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-primary-dark transition flex items-center justify-center gap-2 shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </div>

                    <!-- Product Card 6 -->
                    <div class="product-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl cursor-pointer group animate-scale-in">
                        <div class="relative overflow-hidden">
                            <div class="product-image aspect-square bg-gradient-to-br from-red-50 via-pink-50 to-rose-50"></div>
                            <div class="absolute top-2 left-2">
                                <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded shadow-lg">-50%</span>
                            </div>
                            <button class="absolute top-2 right-2 w-9 h-9 bg-white/90 backdrop-blur rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow-lg hover:bg-white hover:scale-110">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center gap-1 mb-2">
                                <svg class="w-3.5 h-3.5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">4.8</span>
                                <span class="text-xs text-gray-400">• 3.4k terjual</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 text-sm mb-2 line-clamp-2 leading-snug">Sandal Jepit Karet Premium Anti Slip Warna Warni</h4>
                            <div class="mb-3">
                                <div class="text-xs text-gray-400 line-through">Rp 20.000</div>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-xl font-bold text-primary font-display">10K</span>
                                    <span class="text-xs text-gray-500">/pcs</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded-full">
                                    Min. 100 pcs
                                </div>
                                <div class="text-xs font-medium text-green-600 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                    </svg>
                                    Stok ready
                                </div>
                            </div>
                            <button class="w-full bg-primary text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-primary-dark transition flex items-center justify-center gap-2 shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </div>

                    <!-- Product Card 7 -->
                    <div class="product-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl cursor-pointer group animate-scale-in">
                        <div class="relative overflow-hidden">
                            <div class="product-image aspect-square bg-gradient-to-br from-indigo-50 via-blue-50 to-sky-50"></div>
                            <div class="absolute top-2 left-2">
                                <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded shadow-lg">-28%</span>
                            </div>
                            <button class="absolute top-2 right-2 w-9 h-9 bg-white/90 backdrop-blur rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow-lg hover:bg-white hover:scale-110">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center gap-1 mb-2">
                                <svg class="w-3.5 h-3.5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">4.7</span>
                                <span class="text-xs text-gray-400">• 634 terjual</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 text-sm mb-2 line-clamp-2 leading-snug">Tas Ransel Laptop 15 Inch USB Port Anti Air</h4>
                            <div class="mb-3">
                                <div class="text-xs text-gray-400 line-through">Rp 125.000</div>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-xl font-bold text-primary font-display">90K</span>
                                    <span class="text-xs text-gray-500">/pcs</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded-full">
                                    Min. 15 pcs
                                </div>
                                <div class="text-xs font-medium text-green-600 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                    </svg>
                                    Stok ready
                                </div>
                            </div>
                            <button class="w-full bg-primary text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-primary-dark transition flex items-center justify-center gap-2 shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </div>

                    <!-- Product Card 8 -->
                    <div class="product-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl cursor-pointer group animate-scale-in">
                        <div class="relative overflow-hidden">
                            <div class="product-image aspect-square bg-gradient-to-br from-violet-50 via-purple-50 to-fuchsia-50"></div>
                            <div class="absolute top-2 left-2 flex flex-col gap-1">
                                <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded shadow-lg">-32%</span>
                                <span class="bg-purple-500 text-white text-xs font-semibold px-2 py-1 rounded shadow-lg">Recommended</span>
                            </div>
                            <button class="absolute top-2 right-2 w-9 h-9 bg-white/90 backdrop-blur rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow-lg hover:bg-white hover:scale-110">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center gap-1 mb-2">
                                <svg class="w-3.5 h-3.5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">4.9</span>
                                <span class="text-xs text-gray-400">• 1.5k terjual</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 text-sm mb-2 line-clamp-2 leading-snug">Masker Wajah Sheet Mask Vitamin E Moisturizing</h4>
                            <div class="mb-3">
                                <div class="text-xs text-gray-400 line-through">Rp 15.000</div>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-xl font-bold text-primary font-display">10.2K</span>
                                    <span class="text-xs text-gray-500">/pcs</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded-full">
                                    Min. 30 pcs
                                </div>
                                <div class="text-xs font-medium text-green-600 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                    </svg>
                                    Stok ready
                                </div>
                            </div>
                            <button class="w-full bg-primary text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-primary-dark transition flex items-center justify-center gap-2 shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between py-6 border-t border-gray-200">
                    <div class="text-sm text-gray-600">
                        Menampilkan <span class="font-semibold">1-24</span> dari <span class="font-semibold">1,234</span> produk
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                            Sebelumnya
                        </button>
                        <button class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-semibold">1</button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">2</button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">3</button>
                        <span class="px-2 text-gray-500">...</span>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">52</button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Selanjutnya
                        </button>
                    </div>
                </div>
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
                <span class="text-xs mt-1 {{ request()->routeIs('dropshipper.catalog') ? 'font-semibold' : '' }}">Produk</span>
            </a>
            <a href="{{ route('dropshipper.orders') }}" class="flex flex-col items-center justify-center {{ request()->routeIs('dropshipper.orders') ? 'text-primary' : 'text-gray-700 hover:text-primary' }} transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <span class="text-xs mt-1">Pesanan</span>
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

    <script>
        // Add smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Add interactive hover effects
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>
