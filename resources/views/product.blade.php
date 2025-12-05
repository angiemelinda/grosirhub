<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - GrosirHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#ff6b35',
                        secondary: '#f7931e',
                        dark: '#1a1a1a',
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <div class="bg-gradient-to-r from-primary to-secondary p-2 rounded-lg">
                        <i class="fas fa-box-open text-white text-2xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-dark">Grosir<span class="text-primary">Hub</span></span>
                </div>
                
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary transition">Beranda</a>
                        <a href="{{ route('product') }}" class="text-primary font-semibold">Produk</a>
                        <a href="{{ route('supplier') }}" class="text-gray-700 hover:text-primary transition">Supplier</a>
                        <a href="{{ route('cara_kerja') }}" class="text-gray-700 hover:text-primary transition">Cara Kerja</a>
                        <a href="{{ route('kontak') }}" class="text-gray-700 hover:text-primary transition">Kontak</a>
                </div>

                <div class="flex items-center space-x-4">
                    <button class="text-gray-700 hover:text-primary transition">
                        <i class="fas fa-search text-xl"></i>
                    </button>
                    <a href="{{ route('login') }}" class="bg-white border-2 border-primary text-primary px-6 py-2 rounded-lg hover:bg-primary hover:text-white transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-primary to-secondary text-white px-6 py-2 rounded-lg hover:shadow-lg transition">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-orange-50 to-orange-100 py-12">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl font-bold text-dark mb-4">Jelajahi Produk Grosir</h1>
                <p class="text-lg text-gray-600 mb-8">Ribuan produk berkualitas dari supplier terpercaya dengan harga grosir terbaik</p>
                
                <!-- Search & Filter -->
                <div class="bg-white rounded-lg shadow-md p-4 flex flex-col md:flex-row gap-3">
                    <div class="flex-1 relative">
                        <input type="text" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <select class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option>Semua Kategori</option>
                        <option>Fashion</option>
                        <option>Elektronik</option>
                        <option>Makanan & Minuman</option>
                        <option>Kecantikan</option>
                        <option>Rumah Tangga</option>
                    </select>
                    <button class="bg-gradient-to-r from-primary to-secondary text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                        Cari
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Filters & Products -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Sidebar Filters -->
                <div class="w-full md:w-64">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                        <h3 class="font-bold text-lg mb-4">Filter</h3>
                        
                        <!-- Category Filter -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-sm text-gray-700 mb-3">Kategori</h4>
                            <div class="space-y-2">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded">
                                    <span class="ml-2 text-sm text-gray-700">Fashion (234)</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded">
                                    <span class="ml-2 text-sm text-gray-700">Elektronik (156)</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded">
                                    <span class="ml-2 text-sm text-gray-700">Makanan (189)</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded">
                                    <span class="ml-2 text-sm text-gray-700">Kecantikan (145)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Price Filter -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-sm text-gray-700 mb-3">Harga</h4>
                            <div class="flex gap-2 mb-2">
                                <input type="number" placeholder="Min" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg">
                                <input type="number" placeholder="Max" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg">
                            </div>
                        </div>

                        <!-- MOQ Filter -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-sm text-gray-700 mb-3">Minimum Order</h4>
                            <div class="space-y-2">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="moq" class="w-4 h-4 text-primary border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">1-10 pcs</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="moq" class="w-4 h-4 text-primary border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">11-50 pcs</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="moq" class="w-4 h-4 text-primary border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">50+ pcs</span>
                                </label>
                            </div>
                        </div>

                        <button class="w-full bg-primary text-white py-2 rounded-lg hover:bg-secondary transition">
                            Terapkan Filter
                        </button>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="flex-1">
                    <!-- Sort & View Options -->
                    <div class="flex justify-between items-center mb-6">
                        <p class="text-gray-600">Menampilkan <span class="font-semibold">724</span> produk</p>
                        <select class="px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary">
                            <option>Terbaru</option>
                            <option>Harga Terendah</option>
                            <option>Harga Tertinggi</option>
                            <option>Terpopuler</option>
                        </select>
                    </div>

                    <!-- Products -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Product Card 1 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition group">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400" alt="Product" class="w-full h-48 object-cover">
                                <span class="absolute top-2 left-2 bg-primary text-white text-xs px-2 py-1 rounded">HOT</span>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-2 line-clamp-2">Jam Tangan Premium Sport Edition</h3>
                                <p class="text-sm text-gray-500 mb-2">Fashion</p>
                                <div class="flex items-center justify-between mb-3">
                                    <div>
                                        <p class="text-2xl font-bold text-primary">Rp 125.000</p>
                                        <p class="text-xs text-gray-500">Min. Order: 10 pcs</p>
                                    </div>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mb-3">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span class="font-semibold mr-1">4.8</span>
                                    <span>(125 review)</span>
                                </div>
                                <button class="w-full bg-gradient-to-r from-primary to-secondary text-white py-2 rounded-lg hover:shadow-md transition">
                                    <i class="fas fa-shopping-cart mr-2"></i>Pesan Sekarang
                                </button>
                            </div>
                        </div>

                        <!-- Product Card 2 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition group">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400" alt="Product" class="w-full h-48 object-cover">
                                <span class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">PROMO</span>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-2 line-clamp-2">Headphone Wireless Bluetooth 5.0</h3>
                                <p class="text-sm text-gray-500 mb-2">Elektronik</p>
                                <div class="flex items-center justify-between mb-3">
                                    <div>
                                        <p class="text-2xl font-bold text-primary">Rp 85.000</p>
                                        <p class="text-xs text-gray-500">Min. Order: 5 pcs</p>
                                    </div>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mb-3">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span class="font-semibold mr-1">4.9</span>
                                    <span>(89 review)</span>
                                </div>
                                <button class="w-full bg-gradient-to-r from-primary to-secondary text-white py-2 rounded-lg hover:shadow-md transition">
                                    <i class="fas fa-shopping-cart mr-2"></i>Pesan Sekarang
                                </button>
                            </div>
                        </div>

                        <!-- Product Card 3 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition group">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400" alt="Product" class="w-full h-48 object-cover">
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-2 line-clamp-2">Sepatu Sneakers Casual Premium</h3>
                                <p class="text-sm text-gray-500 mb-2">Fashion</p>
                                <div class="flex items-center justify-between mb-3">
                                    <div>
                                        <p class="text-2xl font-bold text-primary">Rp 175.000</p>
                                        <p class="text-xs text-gray-500">Min. Order: 12 pcs</p>
                                    </div>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mb-3">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span class="font-semibold mr-1">4.7</span>
                                    <span>(234 review)</span>
                                </div>
                                <button class="w-full bg-gradient-to-r from-primary to-secondary text-white py-2 rounded-lg hover:shadow-md transition">
                                    <i class="fas fa-shopping-cart mr-2"></i>Pesan Sekarang
                                </button>
                            </div>
                        </div>

                        <!-- Product Card 4 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition group">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1556228720-195a672e8a03?w=400" alt="Product" class="w-full h-48 object-cover">
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-2 line-clamp-2">Tas Ransel Travel Anti Air</h3>
                                <p class="text-sm text-gray-500 mb-2">Fashion</p>
                                <div class="flex items-center justify-between mb-3">
                                    <div>
                                        <p class="text-2xl font-bold text-primary">Rp 95.000</p>
                                        <p class="text-xs text-gray-500">Min. Order: 8 pcs</p>
                                    </div>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mb-3">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span class="font-semibold mr-1">4.6</span>
                                    <span>(67 review)</span>
                                </div>
                                <button class="w-full bg-gradient-to-r from-primary to-secondary text-white py-2 rounded-lg hover:shadow-md transition">
                                    <i class="fas fa-shopping-cart mr-2"></i>Pesan Sekarang
                                </button>
                            </div>
                        </div>

                        <!-- Product Card 5 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition group">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=400" alt="Product" class="w-full h-48 object-cover">
                                <span class="absolute top-2 left-2 bg-primary text-white text-xs px-2 py-1 rounded">NEW</span>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-2 line-clamp-2">Sunglasses Fashion Unisex</h3>
                                <p class="text-sm text-gray-500 mb-2">Fashion</p>
                                <div class="flex items-center justify-between mb-3">
                                    <div>
                                        <p class="text-2xl font-bold text-primary">Rp 55.000</p>
                                        <p class="text-xs text-gray-500">Min. Order: 20 pcs</p>
                                    </div>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mb-3">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span class="font-semibold mr-1">4.5</span>
                                    <span>(45 review)</span>
                                </div>
                                <button class="w-full bg-gradient-to-r from-primary to-secondary text-white py-2 rounded-lg hover:shadow-md transition">
                                    <i class="fas fa-shopping-cart mr-2"></i>Pesan Sekarang
                                </button>
                            </div>
                        </div>

                        <!-- Product Card 6 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition group">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1585386959984-a4155224a1ad?w=400" alt="Product" class="w-full h-48 object-cover">
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-2 line-clamp-2">Parfum Body Spray Wangi Tahan Lama</h3>
                                <p class="text-sm text-gray-500 mb-2">Kecantikan</p>
                                <div class="flex items-center justify-between mb-3">
                                    <div>
                                        <p class="text-2xl font-bold text-primary">Rp 35.000</p>
                                        <p class="text-xs text-gray-500">Min. Order: 24 pcs</p>
                                    </div>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mb-3">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span class="font-semibold mr-1">4.8</span>
                                    <span>(156 review)</span>
                                </div>
                                <button class="w-full bg-gradient-to-r from-primary to-secondary text-white py-2 rounded-lg hover:shadow-md transition">
                                    <i class="fas fa-shopping-cart mr-2"></i>Pesan Sekarang
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center items-center mt-8 space-x-2">
                        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-4 py-2 bg-primary text-white rounded-lg">1</button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">4</button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-12 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="bg-gradient-to-r from-primary to-secondary p-2 rounded-lg">
                            <i class="fas fa-box-open text-white text-xl"></i>
                        </div>
                        <span class="text-xl font-bold">Grosir<span class="text-primary">Hub</span></span>
                    </div>
                    <p class="text-gray-400">Platform B2B terpercaya untuk menghubungkan supplier dan dropshipper di seluruh Indonesia.</p>
                </div>

                <div>
                    <h4 class="font-bold mb-4 text-lg">Produk</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-primary transition">Fitur</a></li>
                        <li><a href="#" class="hover:text-primary transition">Harga</a></li>
                        <li><a href="#" class="hover:text-primary transition">Dokumentasi</a></li>
                        <li><a href="#" class="hover:text-primary transition">API</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4 text-lg">Perusahaan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-primary transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-primary transition">Blog</a></li>
                        <li><a href="#" class="hover:text-primary transition">Karir</a></li>
                        <li><a href="#" class="hover:text-primary transition">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4 text-lg">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="bg-gray-800 p-3 rounded-lg hover:bg-primary transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="bg-gray-800 p-3 rounded-lg hover:bg-primary transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="bg-gray-800 p-3 rounded-lg hover:bg-primary transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="bg-gray-800 p-3 rounded-lg hover:bg-primary transition">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2025 GrosirHub. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>