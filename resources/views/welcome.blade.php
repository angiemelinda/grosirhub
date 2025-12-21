<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrosirHub - Platform B2B Supplier & Dropshipper</title>
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
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <div class="inline-block bg-orange-200 text-primary px-3 py-1 rounded-full text-xs font-semibold mb-3">
                        <i class="fas fa-star"></i> Platform B2B Terpercaya
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-dark mb-4 leading-tight">
                        Hubungkan <span class="text-primary">Supplier</span> dan <span class="text-primary">Dropshipper</span> dalam Satu Platform
                    </h1>
                    <p class="text-base text-gray-600 mb-6">
                        Tingkatkan bisnis grosir Anda dengan platform digital yang memudahkan transaksi, manajemen stok, dan kolaborasi B2B.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 mb-8">
                        <button class="bg-gradient-to-r from-primary to-secondary text-white px-6 py-3 rounded-lg text-base font-semibold hover:shadow-xl transition transform hover:-translate-y-1">
                            Mulai Sekarang <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                        <button class="bg-white text-gray-700 px-6 py-3 rounded-lg text-base font-semibold border-2 border-gray-300 hover:border-primary transition">
                            <i class="fas fa-play-circle mr-2"></i> Lihat Demo
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <div class="text-2xl font-bold text-primary">500+</div>
                            <div class="text-sm text-gray-600">Supplier Aktif</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-primary">2.000+</div>
                            <div class="text-sm text-gray-600">Dropshipper</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-primary">10K+</div>
                            <div class="text-sm text-gray-600">Produk</div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="bg-white p-4 rounded-xl shadow-xl">
                        <img src="{{ asset('images/warehouse.jpg') }}" alt="Dashboard" class="rounded-lg w-full">
                    </div>
                    <div class="absolute -bottom-4 -left-4 bg-white p-3 rounded-lg shadow-lg">
                        <div class="flex items-center space-x-2">
                            <div class="bg-green-100 p-2 rounded-full">
                                <i class="fas fa-check-circle text-green-500 text-lg"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold">Transaksi Aman</div>
                                <div class="text-xs text-gray-500">Sistem terjamin</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-dark mb-4">Fitur Unggulan Platform</h2>
                <p class="text-xl text-gray-600">Solusi lengkap untuk kebutuhan bisnis B2B Anda</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition group">
                    <div class="bg-gradient-to-br from-primary to-secondary p-4 rounded-xl w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-handshake text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-dark">Koneksi Langsung</h3>
                    <p class="text-gray-600 mb-4">Hubungkan supplier dan dropshipper secara langsung tanpa perantara untuk efisiensi maksimal.</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition group">
                    <div class="bg-gradient-to-br from-primary to-secondary p-4 rounded-xl w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-dark">Manajemen Stok Real-time</h3>
                    <p class="text-gray-600 mb-4">Pantau ketersediaan produk secara real-time dengan sistem inventory yang terintegrasi.</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition group">
                    <div class="bg-gradient-to-br from-primary to-secondary p-4 rounded-xl w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-dark">Transaksi Aman</h3>
                    <p class="text-gray-600 mb-4">Sistem pembayaran yang aman dengan perlindungan data dan keamanan tingkat tinggi.</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition group">
                    <div class="bg-gradient-to-br from-primary to-secondary p-4 rounded-xl w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-mobile-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-dark">Akses Multi-Platform</h3>
                    <p class="text-gray-600 mb-4">Kelola bisnis dari mana saja melalui web, mobile, atau tablet dengan sinkronisasi otomatis.</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition group">
                    <div class="bg-gradient-to-br from-primary to-secondary p-4 rounded-xl w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-comments text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-dark">Chat Terintegrasi</h3>
                    <p class="text-gray-600 mb-4">Komunikasi langsung antara supplier dan dropshipper untuk negosiasi dan diskusi produk.</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition group">
                    <div class="bg-gradient-to-br from-primary to-secondary p-4 rounded-xl w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-file-invoice text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-dark">Laporan & Analitik</h3>
                    <p class="text-gray-600 mb-4">Dashboard analitik lengkap untuk memantau performa bisnis dan mengambil keputusan strategis.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="bg-gradient-to-br from-orange-50 to-white py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-dark mb-4">Cara Kerja Platform</h2>
                <p class="text-xl text-gray-600">Proses sederhana untuk memulai bisnis B2B Anda</p>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-gradient-to-br from-primary to-secondary text-white w-20 h-20 rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-6 shadow-lg">1</div>
                    <h3 class="text-xl font-bold mb-3">Daftar Akun</h3>
                    <p class="text-gray-600">Buat akun sebagai supplier atau dropshipper dengan mudah dan gratis</p>
                </div>

                <div class="text-center">
                    <div class="bg-gradient-to-br from-primary to-secondary text-white w-20 h-20 rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-6 shadow-lg">2</div>
                    <h3 class="text-xl font-bold mb-3">Upload Produk</h3>
                    <p class="text-gray-600">Supplier upload produk dan atur harga grosir sesuai kebutuhan</p>
                </div>

                <div class="text-center">
                    <div class="bg-gradient-to-br from-primary to-secondary text-white w-20 h-20 rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-6 shadow-lg">3</div>
                    <h3 class="text-xl font-bold mb-3">Mulai Transaksi</h3>
                    <p class="text-gray-600">Dropshipper browse dan pesan produk dengan sistem yang mudah</p>
                </div>

                <div class="text-center">
                    <div class="bg-gradient-to-br from-primary to-secondary text-white w-20 h-20 rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-6 shadow-lg">4</div>
                    <h3 class="text-xl font-bold mb-3">Kirim & Terima</h3>
                    <p class="text-gray-600">Supplier kirim produk dan dropshipper terima dengan tracking real-time</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-primary to-secondary py-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Siap Mengembangkan Bisnis Grosir Anda?</h2>
            <p class="text-xl text-white mb-8 opacity-90">Bergabunglah dengan ribuan supplier dan dropshipper yang telah sukses</p>
            <div class="flex justify-center space-x-4">
                <button class="bg-white text-primary px-8 py-4 rounded-lg text-lg font-semibold hover:shadow-2xl transition transform hover:-translate-y-1">
                    Daftar sebagai Supplier
                </button>
                <button class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-primary transition">
                    Daftar sebagai Dropshipper
                </button>
            </div>
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