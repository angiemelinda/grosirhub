<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GrosirHub</title>
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
                        <i class="fas fa-sign-in-alt text-white text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-dark mb-1">Selamat Datang</h2>
                    <p class="text-sm text-gray-600">Masuk ke akun GrosirHub Anda</p>
                </div>

                <!-- Form -->
                <form id="loginForm" class="space-y-4" method="POST" action="{{ route('login.post') }}">
                    @csrf
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
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" class="w-3.5 h-3.5 text-primary border-gray-300 rounded focus:ring-primary">
                            <span class="ml-2 text-gray-600">Ingat saya</span>
                        </label>
                        <a href="#" class="text-primary hover:text-secondary font-medium">Lupa password?</a>
                    </div>

                    <button 
                        type="submit"
                        class="w-full bg-gradient-to-r from-primary to-secondary text-white py-2.5 rounded-lg text-sm font-semibold hover:shadow-md transition">
                        Masuk
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-5">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-xs">
                        <span class="px-3 bg-white text-gray-500">Atau masuk dengan</span>
                    </div>
                </div>

                <!-- Social Login -->
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" class="flex items-center justify-center py-2.5 border border-gray-300 rounded-lg text-sm hover:bg-gray-50 transition">
                        <i class="fab fa-google text-red-500 mr-2"></i>
                        Google
                    </button>
                    <button type="button" class="flex items-center justify-center py-2.5 border border-gray-300 rounded-lg text-sm hover:bg-gray-50 transition">
                        <i class="fab fa-facebook text-blue-600 mr-2"></i>
                        Facebook
                    </button>
                </div>

                <!-- Register Link -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-primary hover:text-secondary font-semibold">Daftar sekarang</a>
                    </p>
                </div>
            </div>

            <!-- Info -->
            <div class="mt-6 text-center">
                <p class="text-xs text-gray-500">
                    Dengan masuk, Anda menyetujui 
                    <a href="#" class="text-primary hover:underline">Syarat & Ketentuan</a> dan 
                    <a href="#" class="text-primary hover:underline">Kebijakan Privasi</a>
                </p>
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