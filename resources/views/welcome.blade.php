<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>OutdoorRent - Sewa Alat Petualangan</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS (CDN for instant styling) -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- Konfigurasi Tailwind Kustom -->
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Poppins', 'sans-serif'],
                        },
                        colors: {
                            brand: {
                                500: '#10b981', // Emerald Green
                                600: '#059669',
                                900: '#064e3b',
                            }
                        }
                    }
                }
            }
        </script>

        <style>
            /* Smooth Scroll */
            html {
                scroll-behavior: smooth;
            }
            .hero-bg {
                /* ========================================================================
                   GANTI GAMBAR BACKGROUND DI SINI
                   Ganti URL di dalam url('') dengan link gambar atau path gambar lokal Anda.
                   Contoh: url('/images/gunung.jpg') 
                   ========================================================================
                */
                background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?q=80&w=2070&auto=format&fit=crop');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-800 bg-gray-50">

        <!-- Navbar -->
        <nav id="navbar" class="fixed w-full z-50 transition-all duration-300 bg-transparent py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="#" class="text-2xl font-bold text-white flex items-center gap-2">
                            <svg class="w-8 h-8 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            <span class="text-white">Outdoor<span class="text-brand-500">Rent</span></span>
                        </a>
                    </div>

                    <!-- Menu (Desktop) -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#home" class="text-white hover:text-brand-500 transition">Beranda</a>
                        <a href="#features" class="text-white hover:text-brand-500 transition">Layanan</a>
                        <a href="#equipment" class="text-white hover:text-brand-500 transition">Koleksi</a>
                    </div>

                    <!-- Auth Buttons -->
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-brand-600 text-white rounded-full hover:bg-brand-500 transition shadow-lg font-semibold">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-white hover:text-brand-500 font-medium transition">
                                    Masuk
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-5 py-2 bg-white text-brand-900 rounded-full hover:bg-gray-100 transition shadow-lg font-semibold">
                                        Daftar
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section id="home" class="relative h-screen flex items-center justify-center hero-bg">
            <div class="text-center px-4 max-w-4xl mx-auto relative z-10">
                <span class="uppercase tracking-widest text-brand-500 font-bold mb-4 block animate-bounce">Adventure Awaits</span>
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                    Jelajahi Alam Tanpa Batas
                </h1>
                <p class="text-gray-200 text-lg md:text-xl mb-10 max-w-2xl mx-auto">
                    Sewa peralatan mendaki dan camping terlengkap dengan harga terjangkau. Persiapkan petualanganmu sekarang juga.
                </p>
                <div class="flex flex-col md:flex-row gap-4 justify-center">
                    <a href="#equipment" class="px-8 py-4 bg-brand-600 text-white rounded-full text-lg font-bold hover:bg-brand-500 transition transform hover:-translate-y-1 shadow-xl">
                        Lihat Peralatan
                    </a>
                    @if (!Auth::check())
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-full text-lg font-bold hover:bg-white hover:text-brand-900 transition transform hover:-translate-y-1">
                        Mulai Sekarang
                    </a>
                    @endif
                </div>
            </div>
            
            <!-- Scroll Down Indicator -->
            <div class="absolute bottom-10 animate-pulse text-white">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Mengapa Memilih Kami?</h2>
                    <p class="text-gray-500 max-w-2xl mx-auto">Kami menyediakan layanan terbaik untuk memastikan pengalaman outdoor Anda aman dan menyenangkan.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="p-8 rounded-2xl bg-gray-50 hover:bg-white hover:shadow-xl transition duration-300 border border-gray-100 text-center group">
                        <div class="w-16 h-16 bg-brand-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-brand-600 transition duration-300">
                            <svg class="w-8 h-8 text-brand-600 group-hover:text-white transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Peralatan Terawat</h3>
                        <p class="text-gray-500">Semua alat selalu dicek kebersihannya dan fungsinya setelah pemakaian.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-8 rounded-2xl bg-gray-50 hover:bg-white hover:shadow-xl transition duration-300 border border-gray-100 text-center group">
                        <div class="w-16 h-16 bg-brand-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-brand-600 transition duration-300">
                            <svg class="w-8 h-8 text-brand-600 group-hover:text-white transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Harga Terjangkau</h3>
                        <p class="text-gray-500">Biaya sewa yang ramah di kantong, cocok untuk pelajar dan mahasiswa.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-8 rounded-2xl bg-gray-50 hover:bg-white hover:shadow-xl transition duration-300 border border-gray-100 text-center group">
                        <div class="w-16 h-16 bg-brand-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-brand-600 transition duration-300">
                            <svg class="w-8 h-8 text-brand-600 group-hover:text-white transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Booking Mudah</h3>
                        <p class="text-gray-500">Sistem peminjaman online yang cepat tanpa ribet antri.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Equipment Preview Section -->
        <section id="equipment" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Koleksi Alat</h2>
                        <p class="text-gray-500">Pilihan favorit para pendaki.</p>
                    </div>
                    <a href="#" class="hidden md:inline-flex items-center text-brand-600 font-semibold hover:text-brand-700">
                        Lihat Semua <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Item 1 -->
                    <!-- 
                       ========================================================================
                       GAMBAR CARD 1
                       Ganti src di bawah ini
                       ========================================================================
                    -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition">
                        <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=2070&auto=format&fit=crop" alt="Tenda" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1">Tenda Dome 4P</h3>
                            <p class="text-sm text-gray-500 mb-3">Kapasitas 4 Orang, Waterproof</p>
                            <div class="flex justify-between items-center">
                                <span class="text-brand-600 font-bold">Rp 50.000<span class="text-xs text-gray-400 font-normal">/hari</span></span>
                            </div>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <!-- 
                       ========================================================================
                       GAMBAR CARD 2
                       Ganti src di bawah ini
                       ========================================================================
                    -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition">
                        <img src="https://images.unsplash.com/photo-1553981834-a2394556d59e?q=80&w=2070&auto=format&fit=crop" alt="Carrier" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1">Carrier 60L</h3>
                            <p class="text-sm text-gray-500 mb-3">Backsystem nyaman, Include Cover</p>
                            <div class="flex justify-between items-center">
                                <span class="text-brand-600 font-bold">Rp 35.000<span class="text-xs text-gray-400 font-normal">/hari</span></span>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <!-- 
                       ========================================================================
                       GAMBAR CARD 3
                       Ganti src di bawah ini
                       ========================================================================
                    -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition">
                        <img src="https://images.unsplash.com/photo-1623126905597-9d75046200f4?q=80&w=2070&auto=format&fit=crop" alt="Sepatu" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1">Sepatu Hiking</h3>
                            <p class="text-sm text-gray-500 mb-3">Anti Slip, Waterproof</p>
                            <div class="flex justify-between items-center">
                                <span class="text-brand-600 font-bold">Rp 40.000<span class="text-xs text-gray-400 font-normal">/hari</span></span>
                            </div>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <!-- 
                       ========================================================================
                       GAMBAR CARD 4
                       Ganti src di bawah ini
                       ========================================================================
                    -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition">
                        <img src="https://images.unsplash.com/photo-1516939884455-1445c8652f83?q=80&w=1587&auto=format&fit=crop" alt="Cooking Set" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1">Cooking Set</h3>
                            <p class="text-sm text-gray-500 mb-3">Lengkap untuk 2-3 orang</p>
                            <div class="flex justify-between items-center">
                                <span class="text-brand-600 font-bold">Rp 15.000<span class="text-xs text-gray-400 font-normal">/hari</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-brand-900 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/topography.png')]"></div>
            <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Siap untuk Petualangan Berikutnya?</h2>
                <p class="text-brand-100 text-lg mb-10">Jangan biarkan peralatan menghambat langkahmu. Sewa sekarang dan nikmati alam.</p>
                <a href="{{ route('login') }}" class="inline-block px-10 py-4 bg-white text-brand-900 rounded-full text-lg font-bold hover:bg-brand-50 transition transform hover:-translate-y-1 shadow-xl">
                    Sewa Sekarang
                </a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12 border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <span class="text-2xl font-bold">Outdoor<span class="text-brand-500">Rent</span></span>
                        <p class="text-gray-400 text-sm mt-2">© 2024 OutdoorRent. All rights reserved.</p>
                    </div>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white transition">Instagram</a>
                        <a href="#" class="text-gray-400 hover:text-white transition">Twitter</a>
                        <a href="#" class="text-gray-400 hover:text-white transition">Facebook</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Scripts -->
        <script>
            // Navbar Scroll Effect
            const navbar = document.getElementById('navbar');
            
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('bg-gray-900/90', 'backdrop-blur-md', 'shadow-md', 'py-2');
                    navbar.classList.remove('bg-transparent', 'py-4');
                } else {
                    navbar.classList.remove('bg-gray-900/90', 'backdrop-blur-md', 'shadow-md', 'py-2');
                    navbar.classList.add('bg-transparent', 'py-4');
                }
            });
        </script>
    </body>
</html>