<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Kerja - GrosirHub</title>
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
    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="bg-gradient-to-r from-primary to-secondary p-2 rounded-lg">
                    <i class="fas fa-box-open text-white text-2xl"></i>
                </div>
                <span class="text-2xl font-bold text-dark">Grosir<span class="text-primary">Hub</span></span>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary">Beranda</a>
                <a href="{{ route('product') }}" class="text-gray-700 hover:text-primary">Produk</a>
                <a href="{{ route('supplier') }}" class="text-gray-700 hover:text-primary">Supplier</a>
                <a href="{{ route('cara_kerja') }}" class="text-primary font-semibold border-b-2 border-primary">Cara Kerja</a>
                <a href="{{ route('kontak') }}" class="text-gray-700 hover:text-primary">Kontak</a>
            </div>

            <div class="flex items-center space-x-3">
                <button class="bg-gradient-to-r from-primary to-secondary text-white px-5 py-2 rounded-lg hover:shadow-lg transition">
                    Daftar
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-orange-50 to-orange-100 py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-dark mb-4">Cara Kerja di <span class="text-primary">GrosirHub</span></h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Ikuti langkah sederhana berikut untuk memulai perjalanan bisnis grosir Anda.  
                GrosirHub memudahkan supplier dan dropshipper berkolaborasi dalam satu ekosistem digital yang aman dan efisien.
            </p>
        </div>
    </section>

    <!-- Langkah-Langkah -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-10 text-center">
                <!-- Step 1 -->
                <div class="group">
                    <div class="bg-gradient-to-br from-primary to-secondary w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg text-white text-3xl font-bold">1</div>
                    <h3 class="text-xl font-bold mb-3 text-dark">Daftar Akun</h3>
                    <p class="text-gray-600">Pilih peran Anda sebagai supplier atau dropshipper. Pendaftaran gratis dan cepat!</p>
                </div>

                <!-- Step 2 -->
                <div class="group">
                    <div class="bg-gradient-to-br from-primary to-secondary w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg text-white text-3xl font-bold">2</div>
                    <h3 class="text-xl font-bold mb-3 text-dark">Upload Produk</h3>
                    <p class="text-gray-600">Supplier dapat mengunggah produk lengkap dengan harga grosir dan stok terkini.</p>
                </div>

                <!-- Step 3 -->
                <div class="group">
                    <div class="bg-gradient-to-br from-primary to-secondary w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg text-white text-3xl font-bold">3</div>
                    <h3 class="text-xl font-bold mb-3 text-dark">Mulai Transaksi</h3>
                    <p class="text-gray-600">Dropshipper dapat memilih produk, bernegosiasi, dan melakukan pemesanan secara real-time.</p>
                </div>

                <!-- Step 4 -->
                <div class="group">
                    <div class="bg-gradient-to-br from-primary to-secondary w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg text-white text-3xl font-bold">4</div>
                    <h3 class="text-xl font-bold mb-3 text-dark">Pengiriman & Pembayaran</h3>
                    <p class="text-gray-600">Produk dikirim oleh supplier dengan sistem tracking dan pembayaran yang aman.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Ilustrasi Section -->
    <section class="bg-orange-50 py-20">
        <div class="container mx-auto px-4 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <img src="{{ asset('images/how-it-works.jpg') }}" alt="Ilustrasi Cara Kerja" class="rounded-xl shadow-lg w-full">
            </div>
            <div>
                <h2 class="text-3xl font-bold text-dark mb-4">Kolaborasi Tanpa Batas</h2>
                <p class="text-gray-600 mb-4">Platform GrosirHub memberikan kemudahan komunikasi antara supplier dan dropshipper. 
                    Semua proses mulai dari pencarian produk, negosiasi harga, hingga pembayaran dan pengiriman dilakukan secara terintegrasi.</p>
                <p class="text-gray-600 mb-6">Dengan sistem berbasis teknologi, semua data transaksi terekam secara otomatis, 
                    memberikan transparansi dan efisiensi untuk semua pihak.</p>
                <button class="bg-gradient-to-r from-primary to-secondary text-white px-6 py-3 rounded-lg hover:shadow-xl transition">
                    Mulai Sekarang <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="bg-gradient-to-r from-primary to-secondary py-16 text-center text-white">
        <h2 class="text-4xl font-bold mb-4">Siap Meningkatkan Skala Bisnis Anda?</h2>
        <p class="text-lg mb-8 opacity-90">Daftar sekarang sebagai Supplier atau Dropshipper dan rasakan kemudahannya!</p>
        <div class="flex justify-center space-x-4">
            <button class="bg-white text-primary px-8 py-4 rounded-lg text-lg font-semibold hover:shadow-2xl transition transform hover:-translate-y-1">
                Daftar sebagai Supplier
            </button>
            <button class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-primary transition">
                Daftar sebagai Dropshipper
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-10">
        <div class="container mx-auto text-center">
            <p class="text-gray-400">&copy; 2025 GrosirHub. Semua hak cipta dilindungi.</p>
        </div>
    </footer>
</body>
</html>
