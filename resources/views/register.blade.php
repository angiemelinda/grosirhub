<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - GrosirHub</title>
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
    <nav class="bg-white border-b border-gray-200">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <a href="#" class="flex items-center space-x-2">
                    <div class="bg-gradient-to-r from-primary to-secondary p-1.5 rounded-lg">
                        <i class="fas fa-box-open text-white text-lg"></i>
                    </div>
                    <span class="text-xl font-bold text-dark">Grosir<span class="text-primary">Hub</span></span>
                </a>
                
                <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-primary transition flex items-center">
                    <i class="fas fa-arrow-left text-xs mr-1.5"></i> Beranda
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-md">
            <!-- Card -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <!-- Header -->
                <div class="text-center mb-6">
                    <div class="inline-block bg-gradient-to-br from-primary to-secondary p-2.5 rounded-xl mb-3">
                        <i class="fas fa-user-plus text-white text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-dark mb-1">Buat Akun Baru</h2>
                    <p class="text-sm text-gray-600">Bergabung dan mulai berbisnis</p>
                </div>

                <!-- Form -->
                <form id="registerForm" class="space-y-4" method="POST" action="{{ route('register.post') }}">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5" for="name">
                            Nama Lengkap
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400 text-sm"></i>
                            </div>
                            <input 
                                type="text" 
                                id="name" name="name"
                                class="w-full pl-10 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                placeholder="Nama lengkap Anda"
                                required
                            >
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5" for="email">
                            Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400 text-sm"></i>
                            </div>
                            <input 
                                type="email" 
                                id="email" name="email"
                                class="w-full pl-10 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                placeholder="nama@email.com"
                                required
                            >
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5" for="phone">
                            No. Telepon
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400 text-sm"></i>
                            </div>
                            <input 
                                type="tel" 
                                id="phone" name="phone"
                                class="w-full pl-10 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                placeholder="08xxxxxxxxxx"
                                required
                            >
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5" for="role">
                            Daftar Sebagai
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-briefcase text-gray-400 text-sm"></i>
                            </div>
                            <select 
                                id="role" name="role"
                                class="w-full pl-10 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition appearance-none"
                                required
                            >
                                <option value="">Pilih peran Anda</option>
                                <option value="supplier">Supplier</option>
                                <option value="dropshipper">Dropshipper</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5" for="password">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400 text-sm"></i>
                            </div>
                            <input 
                                type="password" 
                                id="password" name="password"
                                class="w-full pl-10 pr-10 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                placeholder="••••••••"
                                required
                            >
                            <button 
                                type="button"
                                onclick="togglePassword('password')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-primary">
                                <i class="fas fa-eye text-sm"></i>
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5" for="confirmPassword">
                            Konfirmasi Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400 text-sm"></i>
                            </div>
                            <input 
                                type="password" 
                                id="confirmPassword" name="password_confirmation"
                                class="w-full pl-10 pr-10 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                placeholder="••••••••"
                                required
                            >
                            <button 
                                type="button"
                                onclick="togglePassword('confirmPassword')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-primary">
                                <i class="fas fa-eye text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="flex items-start cursor-pointer">
                            <input type="checkbox" id="terms" class="w-3.5 h-3.5 text-primary border-gray-300 rounded focus:ring-primary mt-0.5" required>
                            <span class="ml-2 text-xs text-gray-600">
                                Saya setuju dengan <a href="#" class="text-primary hover:underline font-medium">Syarat & Ketentuan</a> dan <a href="#" class="text-primary hover:underline font-medium">Kebijakan Privasi</a>
                            </span>
                        </label>
                    </div>

                    <button 
                        type="submit"
                        class="w-full bg-gradient-to-r from-primary to-secondary text-white py-2.5 rounded-lg text-sm font-semibold hover:shadow-md transition">
                        Daftar Sekarang
                    </button>
                </form>

                <!-- Login Link -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-primary hover:text-secondary font-semibold">Masuk</a>
                    </p>
                </div>
            </div>

            <!-- Benefits -->
            <div class="mt-6 grid grid-cols-3 gap-3">
                <div class="bg-white rounded-lg p-3 text-center shadow-sm">
                    <i class="fas fa-shield-alt text-primary text-lg mb-1"></i>
                    <p class="text-xs font-medium text-gray-700">Aman</p>
                </div>
                <div class="bg-white rounded-lg p-3 text-center shadow-sm">
                    <i class="fas fa-bolt text-primary text-lg mb-1"></i>
                    <p class="text-xs font-medium text-gray-700">Cepat</p>
                </div>
                <div class="bg-white rounded-lg p-3 text-center shadow-sm">
                    <i class="fas fa-gift text-primary text-lg mb-1"></i>
                    <p class="text-xs font-medium text-gray-700">Gratis</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Pengiriman form ditangani oleh backend Laravel melalui action di atas
    </script>
</body>
</html>