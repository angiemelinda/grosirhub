<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier - GrosirHub</title>
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
                    <a href="{{ route('product') }}" class="text-gray-700 hover:text-primary transition">Produk</a>
                    <a href="{{ route('supplier') }}" class="text-primary font-semibold">Supplier</a>
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
                <h1 class="text-4xl font-bold text-dark mb-4">Supplier Terpercaya</h1>
                <p class="text-lg text-gray-600 mb-8">Temukan supplier berkualitas dengan reputasi terbaik untuk kebutuhan bisnis Anda</p>
                
                <!-- Search -->
                <div class="bg-white rounded-lg shadow-md p-4 flex flex-col md:flex-row gap-3">
                    <div class="flex-1 relative">
                        <input type="text" placeholder="Cari supplier atau lokasi..." class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <select class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option>Semua Kategori</option>
                        <option>Fashion</option>
                        <option>Elektronik</option>
                        <option>Makanan & Minuman</option>
                        <option>Kecantikan</option>
                    </select>
                    <button class="bg-gradient-to-r from-primary to-secondary text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                        Cari
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-8 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary mb-1">500+</div>
                    <div class="text-sm text-gray-600">Supplier Aktif</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary mb-1">10K+</div>
                    <div class="text-sm text-gray-600">Produk Tersedia</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary mb-1">4.8</div>
                    <div class="text-sm text-gray-600">Rating Rata-rata</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary mb-1">98%</div>
                    <div class="text-sm text-gray-600">Kepuasan Pelanggan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Suppliers List -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Sidebar Filters -->
                <div class="w-full md:w-64">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                        <h3 class="font-bold text-lg mb-4">Filter</h3>
                        
                        <!-- Location -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-sm text-gray-700 mb-3">Lokasi</h4>
                            <div class="space-y-2">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded">
                                    <span class="ml-2 text-sm text-gray-700">Jakarta (125)</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded">
                                    <span class="ml-2 text-sm text-gray-700">Bandung (89)</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded">
                                    <span class="ml-2 text-sm text-gray-700">Surabaya (76)</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded">
                                    <span class="ml-2 text-sm text-gray-700">Semarang (54)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Rating -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-sm text-gray-700 mb-3">Rating</h4>
                            <div class="space-y-2">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded">
                                    <span class="ml-2 text-sm text-gray-700 flex items-center">
                                        <i class="fas fa-star text-yellow-400 text-xs mr-1"></i> 4.5+
                                    </span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded">
                                    <span class="ml-2 text-sm text-gray-700 flex items-center">
                                        <i class="fas fa-star text-yellow-400 text-xs mr-1"></i> 4.0+
                                    </span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded">
                                    <span class="ml-2 text-sm text-gray-700 flex items-center">
                                        <i class="fas fa-star text-yellow-400 text-xs mr-1"></i> 3.5+
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- Verified -->
                        <div class="mb-6">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded">
                                <span class="ml-2 text-sm text-gray-700">
                                    <i class="fas fa-check-circle text-blue-500 mr-1"></i> Terverifikasi
                                </span>
                            </label>
                        </div>

                        <button class="w-full bg-primary text-white py-2 rounded-lg hover:bg-secondary transition">
                            Terapkan Filter
                        </button>
                    </div>
                </div>

                <!-- Suppliers Grid -->
                <div class="flex-1">
                    <!-- Sort Options -->
                    <div class="flex justify-between items-center mb-6">
                        <p class="text-gray-600">Menampilkan <span class="font-semibold">500</span> supplier</p>
                        <select class="px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary">
                            <option>Paling Relevan</option>
                            <option>Rating Tertinggi</option>
                            <option>Terbanyak Produk</option>
                            <option>Terbaru</option>
                        </select>
                    </div>

                    <div class="space-y-6">
                        <!-- Supplier Card 1 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <!-- Logo -->
                                    <div class="flex-shrink-0">
                                        <div class="w-24 h-24 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center text-white text-3xl font-bold">
                                            CV
                                        </div>
                                    </div>
                                    
                                    <!-- Info -->
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between mb-2">
                                            <div>
                                                <h3 class="text-xl font-bold text-dark flex items-center">
                                                    CV. Cahaya Variasi
                                                    <i class="fas fa-check-circle text-blue-500 text-sm ml-2" title="Terverifikasi"></i>
                                                </h3>
                                                <p class="text-sm text-gray-500">Fashion & Aksesoris</p>
                                            </div>
                                            <div class="flex items-center bg-yellow-50 px-3 py-1 rounded-full">
                                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                                <span class="font-bold text-sm">4.9</span>
                                                <span class="text-xs text-gray-500 ml-1">(234)</span>
                                            </div>
                                        </div>
                                        
                                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                            Supplier fashion terpercaya dengan pengalaman 10+ tahun. Menyediakan berbagai produk fashion berkualitas dengan harga kompetitif.
                                        </p>
                                        
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                                Jakarta
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-box text-primary mr-2"></i>
                                                1.245 Produk
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-shopping-cart text-primary mr-2"></i>
                                                Min. 10 pcs
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-clock text-primary mr-2"></i>
                                                2-3 hari
                                            </div>
                                        </div>
                                        
                                        <div class="flex flex-wrap gap-2">
                                            <button class="bg-gradient-to-r from-primary to-secondary text-white px-6 py-2 rounded-lg text-sm font-semibold hover:shadow-md transition">
                                                <i class="fas fa-store mr-2"></i>Kunjungi Toko
                                            </button>
                                            <button class="bg-white border-2 border-primary text-primary px-6 py-2 rounded-lg text-sm font-semibold hover:bg-primary hover:text-white transition">
                                                <i class="fas fa-comment mr-2"></i>Chat
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Supplier Card 2 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <div class="flex-shrink-0">
                                        <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white text-3xl font-bold">
                                            TE
                                        </div>
                                    </div>
                                    
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between mb-2">
                                            <div>
                                                <h3 class="text-xl font-bold text-dark flex items-center">
                                                    PT. Teknologi Electronics
                                                    <i class="fas fa-check-circle text-blue-500 text-sm ml-2"></i>
                                                </h3>
                                                <p class="text-sm text-gray-500">Elektronik & Gadget</p>
                                            </div>
                                            <div class="flex items-center bg-yellow-50 px-3 py-1 rounded-full">
                                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                                <span class="font-bold text-sm">4.8</span>
                                                <span class="text-xs text-gray-500 ml-1">(456)</span>
                                            </div>
                                        </div>
                                        
                                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                            Distributor elektronik dan gadget terlengkap. Produk original dengan garansi resmi. Melayani pengiriman ke seluruh Indonesia.
                                        </p>
                                        
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                                Bandung
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-box text-primary mr-2"></i>
                                                2.156 Produk
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-shopping-cart text-primary mr-2"></i>
                                                Min. 5 pcs
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-clock text-primary mr-2"></i>
                                                1-2 hari
                                            </div>
                                        </div>
                                        
                                        <div class="flex flex-wrap gap-2">
                                            <button class="bg-gradient-to-r from-primary to-secondary text-white px-6 py-2 rounded-lg text-sm font-semibold hover:shadow-md transition">
                                                <i class="fas fa-store mr-2"></i>Kunjungi Toko
                                            </button>
                                            <button class="bg-white border-2 border-primary text-primary px-6 py-2 rounded-lg text-sm font-semibold hover:bg-primary hover:text-white transition">
                                                <i class="fas fa-comment mr-2"></i>Chat
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Supplier Card 3 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <div class="flex-shrink-0">
                                        <div class="w-24 h-24 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center text-white text-3xl font-bold">
                                            SR
                                        </div>
                                    </div>
                                    
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between mb-2">
                                            <div>
                                                <h3 class="text-xl font-bold text-dark flex items-center">
                                                    UD. Sari Rasa
                                                    <i class="fas fa-check-circle text-blue-500 text-sm ml-2"></i>
                                                </h3>
                                                <p class="text-sm text-gray-500">Makanan & Minuman</p>
                                            </div>
                                            <div class="flex items-center bg-yellow-50 px-3 py-1 rounded-full">
                                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                                <span class="font-bold text-sm">4.7</span>
                                                <span class="text-xs text-gray-500 ml-1">(189)</span>
                                            </div>
                                        </div>
                                        
                                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                            Supplier makanan dan minuman dengan sertifikasi halal dan BPOM. Produk berkualitas dengan harga terjangkau untuk reseller.
                                        </p>
                                        
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                                Surabaya
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-box text-primary mr-2"></i>
                                                856 Produk
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-shopping-cart text-primary mr-2"></i>
                                                Min. 24 pcs
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-clock text-primary mr-2"></i>
                                                3-4 hari
                                            </div>
                                        </div>
                                        
                                        <div class="flex flex-wrap gap-2">
                                            <button class="bg-gradient-to-r from-primary to-secondary text-white px-6 py-2 rounded-lg text-sm font-semibold hover:shadow-md transition">
                                                <i class="fas fa-store mr-2"></i>Kunjungi Toko
                                            </button>
                                            <button class="bg-white border-2 border-primary text-primary px-6 py-2 rounded-lg text-sm font-semibold hover:bg-primary hover:text-white transition">
                                                <i class="fas fa-comment mr-2"></i>Chat
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Supplier Card 4 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <div class="flex-shrink-0">
                                        <div class="w-24 h-24 bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg flex items-center justify-center text-white text-3xl font-bold">
                                            BC
                                        </div>
                                    </div>
                                    
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between mb-2">
                                            <div>
                                                <h3 class="text-xl font-bold text-dark flex items-center">
                                                    PT. Beauty Care Indonesia
                                                    <i class="fas fa-check-circle text-blue-500 text-sm ml-2"></i>
                                                </h3>
                                                <p class="text-sm text-gray-500">Kecantikan & Perawatan</p>
                                            </div>
                                            <div class="flex items-center bg-yellow-50 px-3 py-1 rounded-full">
                                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                                <span class="font-bold text-sm">4.9</span>
                                                <span class="text-xs text-gray-500 ml-1">(678)</span>
                                            </div>
                                        </div>
                                        
                                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                            Distributor resmi produk kecantikan dan perawatan. Produk original dengan harga grosir terbaik. Free sample untuk pembelian tertentu.
                                        </p>
                                        
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                                Jakarta
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-box text-primary mr-2"></i>
                                                3.421 Produk
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-shopping-cart text-primary mr-2"></i>
                                                Min. 12 pcs
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-clock text-primary mr-2"></i>
                                                1-2 hari
                                            </div>
                                        </div>
                                        
                                        <div class="flex flex-wrap gap-2">
                                            <button class="bg-gradient-to-r from-primary to-secondary text-white px-6 py-2 rounded-lg text-sm font-semibold hover:shadow-md transition">
                                                <i class="fas fa-store mr-2"></i>Kunjungi Toko
                                            </button>
                                            <button class="bg-white border-2 border-primary text-primary px-6 py-2 rounded-lg text-sm font-semibold hover:bg-primary hover:text-white transition">
                                                <i class="fas fa-comment mr-2"></i>Chat
                                            </button>
                                        </div>
                                    </div>
                                </div>
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

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-primary to-secondary py-16 mt-12">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Ingin Menjadi Supplier?</h2>
            <p class="text-lg text-white mb-8 opacity-90">Bergabung dengan ribuan supplier sukses dan kembangkan bisnis Anda</p>
            <button class="bg-white text-primary px-8 py-3 rounded-lg text-lg font-semibold hover:shadow-2xl transition transform hover:-translate-y-1">
                Daftar Sebagai Supplier
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-12">
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