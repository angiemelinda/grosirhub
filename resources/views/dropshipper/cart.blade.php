<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - GrosirHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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
                        'display': ['Archivo', 'sans-serif'],
                        'body': ['Work Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Work Sans', sans-serif;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Archivo', sans-serif;
        }

        /* Animations */
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

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.4s ease-out;
        }

        .animate-slide-down {
            animation: slideDown 0.3s ease-out;
        }

        .animate-scale-in {
            animation: scaleIn 0.3s ease-out;
        }

        /* Cart item stagger animation */
        .cart-item:nth-child(1) { animation-delay: 0s; }
        .cart-item:nth-child(2) { animation-delay: 0.05s; }
        .cart-item:nth-child(3) { animation-delay: 0.1s; }
        .cart-item:nth-child(4) { animation-delay: 0.15s; }

        /* Cart item hover effect */
        .cart-item {
            transition: all 0.2s ease;
        }

        .cart-item:hover {
            background-color: #fffbf5;
        }

        /* Custom number input */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        /* Quantity button hover */
        .qty-btn {
            transition: all 0.2s ease;
        }

        .qty-btn:hover {
            background-color: #f97316;
            color: white;
            transform: scale(1.1);
        }

        .qty-btn:active {
            transform: scale(0.95);
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

        /* Checkbox custom style */
        .cart-checkbox:checked {
            background-color: #f97316;
            border-color: #f97316;
        }

        /* Sticky summary card on scroll */
        .sticky-summary {
            position: sticky;
            top: 88px;
        }

        /* Product image hover zoom */
        .product-img-container {
            overflow: hidden;
            border-radius: 0.75rem;
        }

        .product-img {
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .product-img-container:hover .product-img {
            transform: scale(1.08);
        }

        /* Price highlight animation */
        @keyframes priceHighlight {
            0%, 100% { 
                background-color: transparent;
            }
            50% { 
                background-color: #fed7aa;
            }
        }

        .price-updated {
            animation: priceHighlight 0.6s ease-out;
        }

        /* Floating checkout button on mobile */
        @media (max-width: 768px) {
            .mobile-checkout-bar {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background: white;
                border-top: 2px solid #fed7aa;
                box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.1);
                z-index: 50;
            }
        }

        /* Remove button hover */
        .remove-btn {
            transition: all 0.2s ease;
        }

        .remove-btn:hover {
            color: #dc2626;
            transform: rotate(90deg);
        }

        /* Promo code input glow */
        .promo-input:focus {
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
        }

        /* Save for later animation */
        .save-later-btn:hover {
            transform: translateX(4px);
        }
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
                    <a href="index.html" class="text-gray-700 hover:text-primary font-medium">Beranda</a>
                    <a href="product-catalog.html" class="text-gray-700 hover:text-primary font-medium">Produk</a>
                    <a href="orders.html" class="text-gray-700 hover:text-primary font-medium">Pesanan</a>
                    <a href="order-history.html" class="text-gray-700 hover:text-primary font-medium">Riwayat</a>
                </div>

                <!-- Right Section -->
                <div class="flex items-center space-x-4">
                    <!-- Icons -->
                    <div class="flex items-center space-x-4">
                        <a href="#" class="text-primary relative">
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
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Pengaturan Akun</a>
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
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8 pb-32 md:pb-8">
        <!-- Page Header -->
        <div class="mb-6 animate-fade-in">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2 font-display">Keranjang Belanja</h1>
                    <p class="text-gray-600">3 produk siap untuk checkout</p>
                </div>
                <a href="product-catalog.html" class="hidden md:flex items-center gap-2 text-primary hover:text-primary-dark font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Lanjut Belanja
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Cart Items Section -->
            <div class="lg:col-span-2 space-y-4">
                <!-- Select All Header -->
                <div class="bg-white rounded-xl shadow-sm p-4 flex items-center justify-between animate-slide-up">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" class="cart-checkbox w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary cursor-pointer" checked>
                        <span class="font-semibold text-gray-900">Pilih Semua (3 produk)</span>
                    </label>
                    <button class="text-red-600 hover:text-red-700 font-medium text-sm flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus Dipilih
                    </button>
                </div>

                <!-- Cart Item 1 -->
                <div class="cart-item bg-white rounded-xl shadow-sm p-4 md:p-6 animate-slide-up">
                    <div class="flex gap-4">
                        <!-- Checkbox -->
                        <div class="flex-shrink-0 pt-1">
                            <input type="checkbox" class="cart-checkbox w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary cursor-pointer" checked>
                        </div>

                        <!-- Product Image -->
                        <div class="product-img-container w-24 h-24 md:w-32 md:h-32 flex-shrink-0">
                            <div class="product-img w-full h-full bg-gradient-to-br from-orange-100 via-pink-100 to-purple-100 rounded-xl"></div>
                        </div>

                        <!-- Product Details -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4 mb-3">
                                <div class="flex-1">
                                    <h3 class="font-bold text-gray-900 text-lg mb-2 leading-tight">Kaos Polos Premium Cotton Combed 30s Unisex</h3>
                                    <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 mb-3">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path>
                                            </svg>
                                            Varian: Hitam, Size M
                                        </span>
                                    </div>
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-orange-50 text-orange-700 border border-orange-200">
                                        Min. order: 20 pcs
                                    </div>
                                </div>
                                <button class="remove-btn text-gray-400 hover:text-red-600 p-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Price and Quantity -->
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <!-- Quantity Selector -->
                                    <div class="flex items-center border-2 border-gray-300 rounded-lg overflow-hidden">
                                        <button class="qty-btn px-3 py-2 bg-gray-50 hover:bg-primary hover:text-white font-bold text-gray-700">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                            </svg>
                                        </button>
                                        <input type="number" value="50" min="20" class="w-16 text-center py-2 font-semibold text-gray-900 focus:outline-none">
                                        <button class="qty-btn px-3 py-2 bg-gray-50 hover:bg-primary hover:text-white font-bold text-gray-700">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Price per Unit -->
                                    <div>
                                        <div class="text-xs text-gray-500 line-through">Rp 45.000</div>
                                        <div class="text-sm font-semibold text-gray-700">Rp 29.000<span class="text-gray-500">/pcs</span></div>
                                    </div>
                                </div>

                                <!-- Total Price -->
                                <div class="text-right">
                                    <div class="text-sm text-gray-600 mb-1">Total Harga</div>
                                    <div class="text-2xl font-bold text-primary font-display">Rp 1.450.000</div>
                                    <div class="text-xs text-green-600 font-medium mt-1">Hemat Rp 800.000</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Cart Item 2 -->
                <div class="cart-item bg-white rounded-xl shadow-sm p-4 md:p-6 animate-slide-up">
                    <div class="flex gap-4">
                        <!-- Checkbox -->
                        <div class="flex-shrink-0 pt-1">
                            <input type="checkbox" class="cart-checkbox w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary cursor-pointer" checked>
                        </div>

                        <!-- Product Image -->
                        <div class="product-img-container w-24 h-24 md:w-32 md:h-32 flex-shrink-0">
                            <div class="product-img w-full h-full bg-gradient-to-br from-blue-100 via-cyan-100 to-teal-100 rounded-xl"></div>
                        </div>

                        <!-- Product Details -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4 mb-3">
                                <div class="flex-1">
                                    <h3 class="font-bold text-gray-900 text-lg mb-2 leading-tight">Totebag Canvas Premium Printing Custom Logo</h3>
                                    <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 mb-3">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path>
                                            </svg>
                                            Warna: Natural
                                        </span>
                                    </div>
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-orange-50 text-orange-700 border border-orange-200">
                                        Min. order: 50 pcs
                                    </div>
                                </div>
                                <button class="remove-btn text-gray-400 hover:text-red-600 p-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Price and Quantity -->
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <!-- Quantity Selector -->
                                    <div class="flex items-center border-2 border-gray-300 rounded-lg overflow-hidden">
                                        <button class="qty-btn px-3 py-2 bg-gray-50 hover:bg-primary hover:text-white font-bold text-gray-700">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                            </svg>
                                        </button>
                                        <input type="number" value="100" min="50" class="w-16 text-center py-2 font-semibold text-gray-900 focus:outline-none">
                                        <button class="qty-btn px-3 py-2 bg-gray-50 hover:bg-primary hover:text-white font-bold text-gray-700">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Price per Unit -->
                                    <div>
                                        <div class="text-xs text-gray-500 line-through">Rp 35.000</div>
                                        <div class="text-sm font-semibold text-gray-700">Rp 21.000<span class="text-gray-500">/pcs</span></div>
                                    </div>
                                </div>

                                <!-- Total Price -->
                                <div class="text-right">
                                    <div class="text-sm text-gray-600 mb-1">Total Harga</div>
                                    <div class="text-2xl font-bold text-primary font-display">Rp 2.100.000</div>
                                    <div class="text-xs text-green-600 font-medium mt-1">Hemat Rp 1.400.000</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Cart Item 3 -->
                <div class="cart-item bg-white rounded-xl shadow-sm p-4 md:p-6 animate-slide-up">
                    <div class="flex gap-4">
                        <!-- Checkbox -->
                        <div class="flex-shrink-0 pt-1">
                            <input type="checkbox" class="cart-checkbox w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary cursor-pointer" checked>
                        </div>

                        <!-- Product Image -->
                        <div class="product-img-container w-24 h-24 md:w-32 md:h-32 flex-shrink-0">
                            <div class="product-img w-full h-full bg-gradient-to-br from-purple-100 via-pink-100 to-rose-100 rounded-xl"></div>
                        </div>

                        <!-- Product Details -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4 mb-3">
                                <div class="flex-1">
                                    <h3 class="font-bold text-gray-900 text-lg mb-2 leading-tight">Powerbank 10000mAh Fast Charging Type-C PD</h3>
                                    <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 mb-3">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path>
                                            </svg>
                                            Warna: Putih
                                        </span>
                                    </div>
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-orange-50 text-orange-700 border border-orange-200">
                                        Min. order: 10 pcs
                                    </div>
                                </div>
                                <button class="remove-btn text-gray-400 hover:text-red-600 p-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Price and Quantity -->
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <!-- Quantity Selector -->
                                    <div class="flex items-center border-2 border-gray-300 rounded-lg overflow-hidden">
                                        <button class="qty-btn px-3 py-2 bg-gray-50 hover:bg-primary hover:text-white font-bold text-gray-700">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                            </svg>
                                        </button>
                                        <input type="number" value="30" min="10" class="w-16 text-center py-2 font-semibold text-gray-900 focus:outline-none">
                                        <button class="qty-btn px-3 py-2 bg-gray-50 hover:bg-primary hover:text-white font-bold text-gray-700">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Price per Unit -->
                                    <div>
                                        <div class="text-xs text-gray-500 line-through">Rp 80.000</div>
                                        <div class="text-sm font-semibold text-gray-700">Rp 60.000<span class="text-gray-500">/pcs</span></div>
                                    </div>
                                </div>

                                <!-- Total Price -->
                                <div class="text-right">
                                    <div class="text-sm text-gray-600 mb-1">Total Harga</div>
                                    <div class="text-2xl font-bold text-primary font-display">Rp 1.800.000</div>
                                    <div class="text-xs text-green-600 font-medium mt-1">Hemat Rp 600.000</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <!-- Order Summary Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky-summary space-y-4">
                    <!-- Promo Code -->
                    <div class="bg-white rounded-xl shadow-sm p-6 animate-scale-in">
                        <h3 class="font-bold text-gray-900 mb-4 font-display flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z" clip-rule="evenodd"></path>
                                <path d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z"></path>
                            </svg>
                            Kode Promo
                        </h3>
                        <div class="flex gap-2">
                            <input type="text" placeholder="Masukkan kode promo" class="promo-input flex-1 px-4 py-2.5 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            <button class="px-6 py-2.5 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark whitespace-nowrap">
                                Pakai
                            </button>
                        </div>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-orange-50 text-orange-700 border border-orange-200 cursor-pointer hover:bg-orange-100">
                                GROSIR10 - 10% OFF
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-orange-50 text-orange-700 border border-orange-200 cursor-pointer hover:bg-orange-100">
                                HEMAT50K
                            </span>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="bg-white rounded-xl shadow-sm p-6 animate-scale-in">
                        <h3 class="font-bold text-gray-900 mb-6 font-display text-lg">Ringkasan Belanja</h3>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex items-center justify-between text-gray-700">
                                <span>Total Harga (3 produk)</span>
                                <span class="font-semibold">Rp 8.150.000</span>
                            </div>
                            <div class="flex items-center justify-between text-green-600">
                                <span>Total Diskon</span>
                                <span class="font-semibold">- Rp 2.800.000</span>
                            </div>
                            <div class="flex items-center justify-between text-gray-700">
                                <span>Subtotal</span>
                                <span class="font-semibold">Rp 5.350.000</span>
                            </div>
                            <div class="flex items-center justify-between text-gray-700">
                                <div class="flex items-center gap-1">
                                    <span>Biaya Pengiriman</span>
                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-500">Dihitung di checkout</span>
                            </div>
                        </div>

                        <div class="border-t-2 border-gray-200 pt-4 mb-6">
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900 font-display">Total Bayar</span>
                                <div class="text-right">
                                    <div class="text-3xl font-bold text-primary font-display">Rp 5.350.000</div>
                                    <div class="text-xs text-gray-500 mt-1">180 pcs • 3 produk</div>
                                </div>
                            </div>
                        </div>

                        <button class="w-full bg-primary text-white py-4 rounded-xl font-bold text-lg hover:bg-primary-dark transition shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Lanjut ke Pembayaran
                        </button>

                        <div class="mt-4 flex items-center justify-center gap-3 text-sm text-gray-600">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Transaksi Aman
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path>
                                </svg>
                                Pengiriman Cepat
                            </div>
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <div class="bg-white rounded-xl shadow-sm p-6 animate-scale-in">
                        <h4 class="font-semibold text-gray-900 mb-3">Metode Pembayaran Tersedia</h4>
                        <div class="grid grid-cols-3 gap-2">
                            <div class="border-2 border-gray-200 rounded-lg p-2 flex items-center justify-center hover:border-primary cursor-pointer transition">
                                <span class="text-xs font-semibold text-gray-700">BCA</span>
                            </div>
                            <div class="border-2 border-gray-200 rounded-lg p-2 flex items-center justify-center hover:border-primary cursor-pointer transition">
                                <span class="text-xs font-semibold text-gray-700">Mandiri</span>
                            </div>
                            <div class="border-2 border-gray-200 rounded-lg p-2 flex items-center justify-center hover:border-primary cursor-pointer transition">
                                <span class="text-xs font-semibold text-gray-700">BNI</span>
                            </div>
                            <div class="border-2 border-gray-200 rounded-lg p-2 flex items-center justify-center hover:border-primary cursor-pointer transition">
                                <span class="text-xs font-semibold text-gray-700">GoPay</span>
                            </div>
                            <div class="border-2 border-gray-200 rounded-lg p-2 flex items-center justify-center hover:border-primary cursor-pointer transition">
                                <span class="text-xs font-semibold text-gray-700">OVO</span>
                            </div>
                            <div class="border-2 border-gray-200 rounded-lg p-2 flex items-center justify-center hover:border-primary cursor-pointer transition">
                                <span class="text-xs font-semibold text-gray-700">DANA</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Mobile Checkout Bar -->
    <div class="mobile-checkout-bar md:hidden p-4">
        <div class="flex items-center justify-between mb-3">
            <div>
                <div class="text-xs text-gray-600">Total</div>
                <div class="text-2xl font-bold text-primary font-display">Rp 5.350.000</div>
            </div>
            <button class="px-8 py-3 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition shadow-lg">
                Checkout
            </button>
        </div>
        <div class="text-xs text-center text-gray-500">180 pcs • 3 produk dipilih</div>
    </div>

    <script>
        // Quantity adjustment functionality
        document.querySelectorAll('.qty-btn').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input[type="number"]');
                const currentValue = parseInt(input.value);
                const min = parseInt(input.min);
                
                if (this.querySelector('path').getAttribute('d').includes('M20 12H4')) {
                    // Minus button
                    if (currentValue > min) {
                        input.value = currentValue - 1;
                        updatePrice(this.closest('.cart-item'));
                    }
                } else {
                    // Plus button
                    input.value = currentValue + 1;
                    updatePrice(this.closest('.cart-item'));
                }
            });
        });

        // Update price when quantity changes
        function updatePrice(cartItem) {
            const priceElement = cartItem.querySelector('.text-2xl.font-bold.text-primary');
            priceElement.classList.add('price-updated');
            setTimeout(() => {
                priceElement.classList.remove('price-updated');
            }, 600);
        }

        // Select all checkbox functionality
        const selectAllCheckbox = document.querySelector('.bg-white.rounded-xl.shadow-sm.p-4 .cart-checkbox');
        const itemCheckboxes = document.querySelectorAll('.cart-item .cart-checkbox');

        selectAllCheckbox?.addEventListener('change', function() {
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Individual checkbox change
        itemCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const allChecked = Array.from(itemCheckboxes).every(cb => cb.checked);
                if (selectAllCheckbox) {
                    selectAllCheckbox.checked = allChecked;
                }
            });
        });
    </script>
</body>
</html>