<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kontak Kami - GrosirHub</title>
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

<body class="font-sans bg-gray-50 text-dark">

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
        <a href="{{ route('cara_kerja') }}" class="text-gray-700 hover:text-primary">Cara Kerja</a>
        <a href="{{ route('kontak') }}" class="text-primary font-semibold border-b-2 border-primary">Kontak</a>
      </div>

      <div class="flex items-center space-x-3">
        <button class="bg-gradient-to-r from-primary to-secondary text-white px-5 py-2 rounded-lg hover:shadow-lg transition">
          Daftar
        </button>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="bg-gradient-to-br from-orange-50 to-orange-100 py-16 text-center">
    <div class="container mx-auto px-4">
      <h1 class="text-4xl md:text-5xl font-bold text-dark mb-4">Hubungi <span class="text-primary">GrosirHub</span></h1>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Kami siap membantu Anda! Silakan kirim pesan atau hubungi kami melalui informasi di bawah ini.
      </p>
    </div>
  </section>

  <!-- Kontak Section -->
  <section class="max-w-6xl mx-auto px-4 py-16 grid md:grid-cols-2 gap-10">
    <!-- Form Kontak -->
    <div>
      <h2 class="text-3xl font-bold text-dark mb-6">Kirim Pesan</h2>
      <form class="bg-white shadow-lg rounded-xl p-6 space-y-5 border border-gray-100">
        <div>
          <label for="nama" class="block font-semibold mb-1 text-gray-700">Nama Lengkap</label>
          <input type="text" id="nama" placeholder="Masukkan nama Anda"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition">
        </div>

        <div>
          <label for="email" class="block font-semibold mb-1 text-gray-700">Email</label>
          <input type="email" id="email" placeholder="contoh@email.com"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition">
        </div>

        <div>
          <label for="pesan" class="block font-semibold mb-1 text-gray-700">Pesan</label>
          <textarea id="pesan" rows="5" placeholder="Tulis pesan Anda..."
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition"></textarea>
        </div>

        <button type="submit"
          class="bg-gradient-to-r from-primary to-secondary text-white font-semibold px-6 py-2 rounded-lg hover:shadow-lg transition">
          <i class="fas fa-paper-plane mr-2"></i>Kirim Pesan
        </button>
      </form>
    </div>

    <!-- Informasi Kontak -->
    <div class="space-y-6">
      <h2 class="text-3xl font-bold text-dark mb-4">Informasi Kontak</h2>
      <p class="text-gray-600">Kami selalu terbuka untuk pertanyaan, kerja sama, atau saran dari Anda.</p>

      <div class="bg-white shadow-lg rounded-xl p-6 space-y-4 border border-gray-100">
        <div class="flex items-center space-x-3">
          <div class="bg-gradient-to-r from-primary to-secondary text-white p-3 rounded-lg">
            <i class="fas fa-map-marker-alt"></i>
          </div>
          <p>Jl. Merdeka No. 123, Jakarta, Indonesia</p>
        </div>
        <div class="flex items-center space-x-3">
          <div class="bg-gradient-to-r from-primary to-secondary text-white p-3 rounded-lg">
            <i class="fas fa-envelope"></i>
          </div>
          <p>info@grosirhub.com</p>
        </div>
        <div class="flex items-center space-x-3">
          <div class="bg-gradient-to-r from-primary to-secondary text-white p-3 rounded-lg">
            <i class="fas fa-phone"></i>
          </div>
          <p>+62 812-3456-7890</p>
        </div>
      </div>

      <div class="bg-orange-50 p-4 rounded-xl border border-orange-100 shadow-md">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.612583414451!2d106.8271526749915!3d-6.175387393811773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e7e33df93f%3A0x56a2d97b72b94fcb!2sMonas%20(Monumen%20Nasional)!5e0!3m2!1sid!2sid!4v1680000000000!5m2!1sid!2sid"
          width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
      </div>
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
