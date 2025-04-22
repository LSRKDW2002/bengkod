<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Kesehatan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
        }
        .feature-card:hover {
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="#" class="flex items-center py-4 px-2">
                            <i class="fas fa-heartbeat text-blue-600 text-2xl mr-2"></i>
                            <span class="font-semibold text-gray-900 text-lg">DewaSehat</span>
                        </a>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-3">
                    <a href="#features" class="py-4 px-2 text-gray-500 hover:text-blue-600">Fitur</a>
                    <a href="#about" class="py-4 px-2 text-gray-500 hover:text-blue-600">Tentang</a>
                    <a href="{{ route('login') }}" class="py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold mb-6">Sistem Manajemen Kesehatan Modern</h1>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Solusi terintegrasi untuk manajemen pasien, pemeriksaan, dan obat-obatan. 
                Memberikan pengalaman terbaik bagi dokter dan pasien.
            </p>
            <div class="flex flex-col md:flex-row justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                    <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                </a>
                <a href="#features" class="bg-white hover:bg-gray-100 text-blue-600 font-bold py-3 px-6 rounded-lg transition duration-300">
                    <i class="fas fa-info-circle mr-2"></i>Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Fitur Unggulan</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card bg-white p-6 rounded-lg shadow-md">
                    <div class="text-blue-600 mb-4">
                        <i class="fas fa-user-md text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Manajemen Dokter</h3>
                    <p class="text-gray-600">
                        Dokter dapat dengan mudah memeriksa pasien, memberikan resep, dan mengelola catatan medis.
                    </p>
                </div>
                
                <!-- Feature 2 -->
                <div class="feature-card bg-white p-6 rounded-lg shadow-md">
                    <div class="text-blue-600 mb-4">
                        <i class="fas fa-procedures text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Manajemen Pasien</h3>
                    <p class="text-gray-600">
                        Pasien dapat mengajukan pemeriksaan, melihat riwayat, dan mendapatkan notifikasi.
                    </p>
                </div>
                
                <!-- Feature 3 -->
                <div class="feature-card bg-white p-6 rounded-lg shadow-md">
                    <div class="text-blue-600 mb-4">
                        <i class="fas fa-pills text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Manajemen Obat</h3>
                    <p class="text-gray-600">
                        Sistem terintegrasi untuk mengelola stok obat, harga, dan resep dokter.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <img src="https://images.unsplash.com/photo-1581056771107-24ca5f033842?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                         alt="About Us" class="rounded-lg shadow-lg">
                </div>
                <div class="md:w-1/2 md:pl-12">
                    <h2 class="text-3xl font-bold mb-6">Tentang Sistem Kami</h2>
                    <p class="text-gray-600 mb-4">
                        Sistem Manajemen Kesehatan kami dirancang untuk memberikan solusi terbaik dalam pengelolaan data medis 
                        antara dokter dan pasien. Dengan antarmuka yang intuitif, sistem ini memudahkan semua proses administrasi 
                        dan klinis.
                    </p>
                    <p class="text-gray-600 mb-6">
                        Kami berkomitmen untuk menyediakan platform yang aman, andal, dan mudah digunakan bagi semua pengguna.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                            <i class="fas fa-shield-alt mr-1"></i> Aman
                        </span>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                            <i class="fas fa-bolt mr-1"></i> Cepat
                        </span>
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                            <i class="fas fa-mobile-alt mr-1"></i> Responsif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <div class="flex items-center">
                        <i class="fas fa-heartbeat text-2xl text-blue-400 mr-2"></i>
                        <span class="font-semibold text-xl">DewaSehat</span>
                    </div>
                    <p class="text-gray-400 mt-2">Solusi manajemen kesehatan terintegrasi</p>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-6 pt-6 text-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} DewaSehat. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button onclick="topFunction()" id="backToTop" class="fixed bottom-5 right-5 bg-blue-600 text-white p-3 rounded-full shadow-lg opacity-0 invisible transition-all duration-300">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Back to top button
        window.onscroll = function() {scrollFunction()};
        
        function scrollFunction() {
            const btn = document.getElementById("backToTop");
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                btn.classList.remove("opacity-0", "invisible");
                btn.classList.add("opacity-100", "visible");
            } else {
                btn.classList.remove("opacity-100", "visible");
                btn.classList.add("opacity-0", "invisible");
            }
        }
        
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
</body>
</html>