<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>OutdoorRent - Beyond Boundaries</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- GSAP & Lenis for Ultra Smoothness -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
        <script src="https://unpkg.com/@studio-freight/lenis@1.0.29/dist/lenis.min.js"></script>

        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                            display: ['"Space Grotesk"', 'sans-serif'],
                        },
                        colors: {
                            brand: {
                                500: '#00dc82', // Vivid Emerald
                                600: '#00b368',
                                400: '#36e59e',
                                accent: '#cdf443', // Acid Green for pops
                            },
                            dark: {
                                950: '#030305', // True Blackish
                                900: '#0c0c0e',
                                800: '#16161a',
                            }
                        },
                        backgroundImage: {
                            'noise': "url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22 opacity=%220.05%22/%3E%3C/svg%3E')",
                        },
                        animation: {
                            'float': 'float 6s ease-in-out infinite',
                            'float-delayed': 'float 6s ease-in-out 3s infinite',
                            'spin-slow': 'spin 20s linear infinite',
                        },
                        keyframes: {
                            float: {
                                '0%, 100%': { transform: 'translateY(0)' },
                                '50%': { transform: 'translateY(-20px)' },
                            }
                        }
                    }
                }
            }
        </script>

        <style>
            /* Base Reset */
            body { 
                /* Removed generic dark background, handled by fixed div now */
                background-color: #030305;
                cursor: default;
            }
            
            /* Hide scrollbar but keep functionality */
            html.lenis { height: auto; }
            .lenis.lenis-smooth { scroll-behavior: auto; }
            .lenis.lenis-smooth [data-lenis-prevent] { overscroll-behavior: contain; }
            .lenis.lenis-stopped { overflow: hidden; }
            .lenis.lenis-scrolling iframe { pointer-events: none; }
            
            ::-webkit-scrollbar { width: 0px; background: transparent; }

            /* Text Selection */
            ::selection { background: #00dc82; color: #000; }

            /* Utility Classes */
            .text-outline {
                -webkit-text-stroke: 1px rgba(255,255,255,0.2);
                color: transparent;
            }
            
            .glass-panel {
                background: rgba(255, 255, 255, 0.02);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.08);
            }

            .glass-nav {
                background: rgba(3, 3, 5, 0.6);
                backdrop-filter: blur(20px);
                border-bottom: 1px solid rgba(255,255,255,0.05);
            }

            /* Image Reveal Mask */
            .image-mask {
                clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
                transition: clip-path 1.2s cubic-bezier(0.77, 0, 0.175, 1);
            }
            
            /* Gradient Text */
            .text-gradient {
                background: linear-gradient(to right, #fff, #00dc82);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            /* Abstract Mountain CSS */
            .mountain-glass {
                background: linear-gradient(135deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.01) 100%);
                backdrop-filter: blur(10px);
                border-top: 1px solid rgba(255,255,255,0.1);
                border-left: 1px solid rgba(255,255,255,0.1);
                clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
            }
        </style>
    </head>
    <body class="font-sans antialiased text-white overflow-x-hidden relative">

        <!-- GLOBAL FIXED BACKGROUND -->
        <div class="fixed inset-0 z-[-2] pointer-events-none">
            <!-- High quality dark nature texture -->
            <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover opacity-60">
            <!-- Heavy overlay to ensure text readability -->
            <div class="absolute inset-0 bg-dark-950/90 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-dark-950/50 via-transparent to-dark-950/90"></div>
        </div>

        <!-- Noise Overlay (Grain effect) -->
        <div class="fixed inset-0 z-[9999] pointer-events-none bg-noise opacity-40 mix-blend-overlay"></div>

        <!-- Dynamic Background Orbs (Kept but reduced opacity) -->
        <div class="fixed inset-0 z-[-1] pointer-events-none overflow-hidden opacity-50">
            <div class="absolute top-[-10%] left-[-10%] w-[800px] h-[800px] bg-brand-500/10 rounded-full blur-[120px] mix-blend-screen animate-pulse duration-[10000ms]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px] mix-blend-screen animate-pulse duration-[8000ms]"></div>
        </div>

        <!-- Navigation -->
        <nav class="fixed top-0 w-full z-50 transition-all duration-500" id="navbar">
            <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
                <a href="#" class="group flex items-center gap-3 relative z-10">
                    <div class="w-10 h-10 bg-brand-500 rounded-full flex items-center justify-center text-dark-950 transform group-hover:rotate-90 transition-transform duration-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    </div>
                    <span class="font-display font-bold text-xl tracking-tight">Outdoor<span class="text-brand-500">Rent</span>.</span>
                </a>

                <div class="hidden md:flex items-center gap-8 glass-panel px-8 py-3 rounded-full">
                    <a href="#home" class="text-sm font-medium text-white/60 hover:text-white transition-colors relative group">
                        Beranda
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-brand-500 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#featured" class="text-sm font-medium text-white/60 hover:text-white transition-colors relative group">
                        Koleksi
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-brand-500 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#stats" class="text-sm font-medium text-white/60 hover:text-white transition-colors relative group">
                        Tentang
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-brand-500 transition-all group-hover:w-full"></span>
                    </a>
                </div>

                <div class="flex items-center gap-4 relative z-10">
                     @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-white text-dark-950 text-sm font-bold rounded-full hover:bg-brand-500 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-white/80 hover:text-white transition">Log In</a>
                        <a href="{{ route('register') }}" class="group relative px-6 py-2.5 bg-white text-dark-950 text-sm font-bold rounded-full overflow-hidden hover:text-white transition-colors">
                            <span class="absolute inset-0 w-full h-full bg-brand-500 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></span>
                            <span class="relative z-10">Get Started</span>
                        </a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section id="home" class="relative min-h-screen flex items-center justify-center pt-20 px-6 overflow-hidden">
            <!-- Background Image with Parallax (Specific for Hero) -->
            <div class="absolute inset-0 z-0 select-none">
                <!-- Adjusted gradient opacity to let more image show through -->
                <div class="absolute inset-0 bg-gradient-to-t from-dark-950/90 via-dark-950/40 to-transparent z-10"></div>
                <div class="absolute inset-0 bg-dark-950/10 z-10"></div>
                
                <!-- Hiking Image -->
                 <img src="https://images.unsplash.com/photo-1501555088652-021faa106b9b?q=80&w=2070&auto=format&fit=crop" 
                     class="w-full h-full object-cover opacity-100 scale-110" 
                     data-speed="0.5" 
                     id="hero-bg"
                     alt="Hiking Background">
            </div>

            <div class="relative z-10 max-w-7xl w-full mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center min-h-[600px]">
                
                <!-- Left Content -->
                <div class="lg:col-span-7">
                    <div class="gsap-hero-text inline-block mb-6 px-4 py-1.5 rounded-full border border-brand-500/30 bg-brand-500/10 text-brand-500 text-xs font-bold tracking-[0.2em] uppercase backdrop-blur-md">
                        • The Ultimate Rental Experience
                    </div>
                    <h1 class="font-display text-6xl md:text-8xl lg:text-[100px] leading-[0.9] font-bold tracking-tighter mb-8 text-white">
                        <span class="block overflow-hidden"><span class="block gsap-title-line">EXPLORE</span></span>
                        <span class="block overflow-hidden"><span class="block gsap-title-line text-outline">WITHOUT</span></span>
                        <span class="block overflow-hidden"><span class="block gsap-title-line text-brand-500">LIMITS.</span></span>
                    </h1>
                    <p class="gsap-hero-text text-lg text-slate-200/90 max-w-xl leading-relaxed mb-10 border-l-2 border-brand-500/50 pl-6 drop-shadow-lg">
                        Sewa perlengkapan ekspedisi standar internasional. Kami menyediakan gear terbaik agar Anda bisa fokus pada petualangan, bukan logistik.
                    </p>
                    
                    <!-- Search Bar -->
                    <div class="gsap-hero-input max-w-2xl bg-white/10 backdrop-blur-xl border border-white/20 p-2 rounded-[2rem] flex flex-col md:flex-row gap-2 relative z-20 shadow-2xl">
                        <div class="flex-1 relative group">
                            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                            <input type="text" placeholder="Cari: Tenda, Carrier, Sepatu..." class="w-full bg-transparent border-none text-white placeholder-slate-400 pl-12 pr-4 py-4 rounded-3xl focus:ring-0 focus:bg-white/5 transition outline-none h-full placeholder:text-slate-300">
                        </div>
                        <div class="md:w-48 relative border-t md:border-t-0 md:border-l border-white/10 group">
                             <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <input type="text" placeholder="Tanggal" onfocus="(this.type='date')" class="w-full bg-transparent border-none text-white placeholder-slate-400 pl-12 pr-4 py-4 rounded-3xl focus:ring-0 focus:bg-white/5 transition outline-none h-full placeholder:text-slate-300">
                        </div>
                        <button class="bg-brand-500 text-dark-950 font-bold px-8 py-4 rounded-[1.5rem] hover:bg-brand-400 transition transform active:scale-95 shadow-[0_0_20px_rgba(0,220,130,0.4)]">
                            Cari
                        </button>
                    </div>
                </div>

                <!-- Right Visual: Abstract Holographic Mountain -->
                <div class="lg:col-span-5 relative hidden lg:block h-[600px] perspective-1000">
                    
                    <!-- Decorative Circle behind -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] rounded-full border border-white/5 animate-spin-slow"></div>
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[550px] rounded-full border border-dashed border-white/5 animate-spin-slow" style="animation-direction: reverse;"></div>

                    <!-- Holographic Mountain Layers -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        
                        <!-- Back Mountain -->
                        <div class="mountain-glass w-[400px] h-[300px] absolute bottom-[100px] opacity-30 translate-x-[-40px] animate-float-delayed"></div>
                        
                        <!-- Front Mountain -->
                        <div class="mountain-glass w-[450px] h-[350px] absolute bottom-[50px] opacity-60 z-10 animate-float">
                            <!-- Topographic Lines (Simulated with SVG) -->
                            <svg class="absolute inset-0 w-full h-full opacity-30" viewBox="0 0 100 100" preserveAspectRatio="none">
                                <path d="M0,90 Q50,40 100,90" fill="none" stroke="white" stroke-width="0.5" />
                                <path d="M10,95 Q50,55 90,95" fill="none" stroke="white" stroke-width="0.5" />
                                <path d="M20,100 Q50,70 80,100" fill="none" stroke="white" stroke-width="0.5" />
                            </svg>
                        </div>

                        <!-- Floating Gear Card (Interactive) -->
                        <div class="absolute bottom-[100px] right-[20px] z-20 w-64 glass-panel p-4 rounded-2xl animate-float shadow-2xl backdrop-blur-xl bg-dark-950/40" style="animation-duration: 5s;">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 rounded-full bg-brand-500/20 flex items-center justify-center text-brand-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                </div>
                                <div>
                                    <div class="text-[10px] text-slate-300 font-bold uppercase tracking-wider">Trending Now</div>
                                    <div class="text-sm font-bold text-white">Hyperlite Mtn Gear</div>
                                </div>
                            </div>
                            <div class="h-1 w-full bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full w-3/4 bg-brand-500"></div>
                            </div>
                            <div class="flex justify-between items-center mt-2 text-[10px] text-slate-300">
                                <span>Availability</span>
                                <span class="text-brand-500 font-bold">High Demand</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Stats Section -->
        <section id="stats" class="py-24 relative z-10 border-y border-white/5 bg-dark-950/40 backdrop-blur-md">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
                    <div class="stat-item opacity-0 translate-y-10">
                        <div class="text-5xl md:text-6xl font-display font-bold text-white mb-2 counter" data-target="2400">0</div>
                        <div class="text-xs font-bold text-brand-500 uppercase tracking-widest">Active Gear</div>
                    </div>
                    <div class="stat-item opacity-0 translate-y-10">
                        <div class="text-5xl md:text-6xl font-display font-bold text-white mb-2 counter" data-target="18000">0</div>
                        <div class="text-xs font-bold text-brand-500 uppercase tracking-widest">Happy Hikers</div>
                    </div>
                    <div class="stat-item opacity-0 translate-y-10">
                        <div class="text-5xl md:text-6xl font-display font-bold text-white mb-2">100<span class="text-brand-500 text-4xl">%</span></div>
                        <div class="text-xs font-bold text-slate-500 uppercase tracking-widest">Hygienic</div>
                    </div>
                    <div class="stat-item opacity-0 translate-y-10">
                        <div class="text-5xl md:text-6xl font-display font-bold text-white mb-2 counter" data-target="12">0</div>
                        <div class="text-xs font-bold text-slate-500 uppercase tracking-widest">Store Hubs</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Collections (Bento Grid) -->
        <section id="featured" class="py-32 relative z-10">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex flex-col md:flex-row items-end justify-between mb-16 gap-6">
                    <div>
                        <h2 class="text-brand-500 font-bold text-xs uppercase tracking-[0.3em] mb-4">The Collections</h2>
                        <h3 class="font-display text-4xl md:text-5xl font-bold text-white">CHOOSE YOUR <br /><span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 to-blue-500">WEAPON.</span></h3>
                    </div>
                    <a href="#" class="group flex items-center gap-2 text-sm font-bold text-white hover:text-brand-500 transition">
                        View Full Catalog
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 auto-rows-[400px]">
                    <!-- Large Item -->
                    <div class="md:col-span-2 md:row-span-2 group relative rounded-[2.5rem] overflow-hidden bg-dark-900/50 backdrop-blur-sm border border-white/5 cursor-pointer hover:border-brand-500/30 transition-colors">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors z-10"></div>
                        <img src="https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?q=80&w=2070&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark-950 via-dark-950/40 to-transparent z-20"></div>
                        <div class="absolute bottom-0 left-0 p-10 z-30 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            <span class="inline-block px-3 py-1 bg-brand-500 text-dark-950 text-[10px] font-bold uppercase tracking-widest rounded-full mb-4">Shelter Systems</span>
                            <h4 class="font-display text-4xl font-bold text-white mb-2">Expedition Tents</h4>
                            <p class="text-slate-300 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100 max-w-md">Tenda 4-season tahan badai, ringan, dan mudah dipasang. Pilihan terbaik untuk Semeru hingga Carstensz.</p>
                        </div>
                    </div>

                    <!-- Tall Item -->
                    <div class="md:row-span-2 group relative rounded-[2.5rem] overflow-hidden bg-dark-900/50 backdrop-blur-sm border border-white/5 cursor-pointer hover:border-brand-500/30 transition-colors">
                        <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?q=80&w=2070&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 grayscale group-hover:grayscale-0">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark-950 via-transparent to-transparent z-20"></div>
                        <div class="absolute bottom-0 left-0 p-8 z-30">
                            <h4 class="font-display text-3xl font-bold text-white mb-2">Backpacks</h4>
                            <p class="text-sm text-brand-500 font-bold uppercase tracking-widest">Osprey, Gregory, Deuter</p>
                        </div>
                    </div>

                    <!-- Wide Item -->
                    <div class="md:col-span-3 group relative rounded-[2.5rem] overflow-hidden bg-dark-900/50 backdrop-blur-sm border border-white/5 cursor-pointer hover:border-brand-500/30 transition-colors">
                        <div class="absolute inset-0 flex items-center justify-between p-12 z-30">
                            <div class="max-w-lg">
                                <h4 class="font-display text-4xl font-bold text-white mb-4">Footwear & Accessories</h4>
                                <p class="text-slate-300">Sepatu hiking waterproof, trekking pole carbon, dan headlamp 900 lumens.</p>
                            </div>
                            <div class="w-16 h-16 rounded-full border border-white/20 flex items-center justify-center group-hover:bg-brand-500 group-hover:border-brand-500 group-hover:text-dark-950 transition-all duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </div>
                        </div>
                        <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?q=80&w=2070&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-40 group-hover:opacity-60">
                        <div class="absolute inset-0 bg-dark-950/80 group-hover:bg-dark-950/60 transition-colors z-10"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Product Cards 3D -->
        <section class="py-24 bg-dark-900/30 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-6">
                 <div class="text-center mb-20">
                    <h2 class="text-brand-500 font-bold text-xs uppercase tracking-[0.3em] mb-4">Top Rated Gear</h2>
                    <h3 class="font-display text-4xl md:text-5xl font-bold text-white">READY TO DEPLOY.</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Card 1 -->
                    <div class="product-card group perspective-1000">
                        <div class="relative bg-white/5 border border-white/5 rounded-[2rem] p-4 transition-transform duration-500 transform-style-3d hover:border-brand-500/30 hover:shadow-[0_0_30px_rgba(0,220,130,0.15)] backdrop-blur-md">
                            <div class="relative h-64 rounded-[1.5rem] overflow-hidden mb-6 bg-dark-800">
                                <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                <div class="absolute top-3 right-3 bg-brand-500 text-dark-950 text-[10px] font-extrabold px-3 py-1 rounded-full uppercase">Hot</div>
                            </div>
                            <div class="px-2 pb-2">
                                <h4 class="text-xl font-bold text-white mb-1">North Face VE 25</h4>
                                <p class="text-xs text-slate-400 uppercase tracking-wider font-bold mb-4">Expedition Tent</p>
                                <div class="flex items-end justify-between">
                                    <div>
                                        <span class="text-2xl font-display font-bold text-brand-500">Rp 120k</span>
                                        <span class="text-xs text-slate-400">/hari</span>
                                    </div>
                                    <button class="w-10 h-10 rounded-full bg-white/10 hover:bg-brand-500 hover:text-dark-950 flex items-center justify-center transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="product-card group perspective-1000">
                        <div class="relative bg-white/5 border border-white/5 rounded-[2rem] p-4 transition-transform duration-500 transform-style-3d hover:border-brand-500/30 hover:shadow-[0_0_30px_rgba(0,220,130,0.15)] backdrop-blur-md">
                            <div class="relative h-64 rounded-[1.5rem] overflow-hidden mb-6 bg-dark-800">
                                <img src="https://i.pinimg.com/1200x/17/fa/e2/17fae260edcf13e5afce131f6062b070.jpg" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            </div>
                            <div class="px-2 pb-2">
                                <h4 class="text-xl font-bold text-white mb-1">Gregory Baltoro 75</h4>
                                <p class="text-xs text-slate-400 uppercase tracking-wider font-bold mb-4">Heavy Load Carrier</p>
                                <div class="flex items-end justify-between">
                                    <div>
                                        <span class="text-2xl font-display font-bold text-brand-500">Rp 85k</span>
                                        <span class="text-xs text-slate-400">/hari</span>
                                    </div>
                                    <button class="w-10 h-10 rounded-full bg-white/10 hover:bg-brand-500 hover:text-dark-950 flex items-center justify-center transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="product-card group perspective-1000">
                        <div class="relative bg-white/5 border border-white/5 rounded-[2rem] p-4 transition-transform duration-500 transform-style-3d hover:border-brand-500/30 hover:shadow-[0_0_30px_rgba(0,220,130,0.15)] backdrop-blur-md">
                            <div class="relative h-64 rounded-[1.5rem] overflow-hidden mb-6 bg-dark-800">
                                <img src="https://i.pinimg.com/1200x/68/e3/0c/68e30c60a48c6ae7024b56a9a71b17db.jpg" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            </div>
                            <div class="px-2 pb-2">
                                <h4 class="text-xl font-bold text-white mb-1">Salomon Quest 4D</h4>
                                <p class="text-xs text-slate-400 uppercase tracking-wider font-bold mb-4">Gore-Tex Boots</p>
                                <div class="flex items-end justify-between">
                                    <div>
                                        <span class="text-2xl font-display font-bold text-brand-500">Rp 45k</span>
                                        <span class="text-xs text-slate-400">/hari</span>
                                    </div>
                                    <button class="w-10 h-10 rounded-full bg-white/10 hover:bg-brand-500 hover:text-dark-950 flex items-center justify-center transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="product-card group perspective-1000">
                        <div class="relative bg-white/5 border border-white/5 rounded-[2rem] p-4 transition-transform duration-500 transform-style-3d hover:border-brand-500/30 hover:shadow-[0_0_30px_rgba(0,220,130,0.15)] backdrop-blur-md">
                            <div class="relative h-64 rounded-[1.5rem] overflow-hidden mb-6 bg-dark-800">
                                <img src="https://images.unsplash.com/photo-1516939884455-1445c8652f83?q=80&w=1587&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            </div>
                            <div class="px-2 pb-2">
                                <h4 class="text-xl font-bold text-white mb-1">Petzl Swift RL</h4>
                                <p class="text-xs text-slate-400 uppercase tracking-wider font-bold mb-4">900lm Headlamp</p>
                                <div class="flex items-end justify-between">
                                    <div>
                                        <span class="text-2xl font-display font-bold text-brand-500">Rp 25k</span>
                                        <span class="text-xs text-slate-400">/hari</span>
                                    </div>
                                    <button class="w-10 h-10 rounded-full bg-white/10 hover:bg-brand-500 hover:text-dark-950 flex items-center justify-center transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-dark-950/80 backdrop-blur-xl pt-20 border-t border-white/5 pb-10">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-10 mb-16">
                    <div>
                        <h2 class="fonat-display text-4xl font-bold text-white mb-2">Outdoor<span class="text-brand-500">Rent</span>.</h2>
                        <p class="text-slate-400 max-w-sm">Premium adventure gear rental based in Indonesia. We enable your journey.</p>
                    </div>
                    <div class="flex gap-4">
                        <a href="#" class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center hover:bg-brand-500 hover:text-dark-950 hover:border-brand-500 transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center hover:bg-brand-500 hover:text-dark-950 hover:border-brand-500 transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.072 3.269.153 4.792 1.7 4.965 4.965.058 1.267.069 1.649.069 4.85 0 3.205-.012 3.584-.069 4.85-.173 3.267-1.687 4.792-4.965 4.965-1.266.058-1.648.07-4.85.07-3.204 0-3.584-.012-4.85-.069-3.269-.153-4.792-1.687-4.965-4.965-.058-1.266-.07-1.648-.07-4.85 0-3.204 0-3.584.07-4.85.173-3.267 1.687-4.792 4.965-4.965 1.266-.059 1.648-.071 4.85-.071zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>
                <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between text-xs text-slate-500 font-bold uppercase tracking-widest">
                    <p>&copy; 2024 OutdoorRent Inc.</p>
                    <div class="flex gap-6 mt-4 md:mt-0">
                        <a href="#" class="hover:text-white transition">Privacy</a>
                        <a href="#" class="hover:text-white transition">Terms</a>
                        <a href="#" class="hover:text-white transition">Sitemap</a>
                    </div>
                </div>
            </div>
        </footer>

        <script>
            // 1. Initialize Lenis (The "Butter" Smooth Scroll)
            const lenis = new Lenis({
                duration: 1.2,
                easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                direction: 'vertical',
                gestureDirection: 'vertical',
                smooth: true,
                mouseMultiplier: 1,
                smoothTouch: false,
                touchMultiplier: 2,
            });

            function raf(time) {
                lenis.raf(time);
                requestAnimationFrame(raf);
            }
            requestAnimationFrame(raf);

            // Connect GSAP ScrollTrigger to Lenis
            gsap.registerPlugin(ScrollTrigger);

            // 2. Navbar Glass Effect
            const nav = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    nav.classList.add('glass-nav');
                } else {
                    nav.classList.remove('glass-nav');
                }
            });

            // 3. Hero Animations
            const tl = gsap.timeline();
            
            tl.from('.gsap-title-line', {
                y: 100,
                opacity: 0,
                duration: 1.2,
                stagger: 0.15,
                ease: "power4.out",
                delay: 0.2
            })
            .from('.gsap-hero-text', {
                opacity: 0,
                y: 20,
                duration: 1,
                stagger: 0.1,
                ease: "power2.out"
            }, "-=0.8")
            .from('.gsap-hero-input', {
                scale: 0.9,
                opacity: 0,
                duration: 1,
                ease: "back.out(1.7)"
            }, "-=0.8");

            // 4. Parallax Effect for Hero Background
            gsap.to("#hero-bg", {
                scrollTrigger: {
                    trigger: "#home",
                    start: "top top",
                    end: "bottom top",
                    scrub: true
                },
                y: 200, // Move image down slightly slower than scroll
                ease: "none"
            });

            // 5. Stats Counter Animation
            const stats = document.querySelectorAll('.stat-item');
            stats.forEach((stat, index) => {
                gsap.to(stat, {
                    scrollTrigger: {
                        trigger: "#stats",
                        start: "top 80%",
                    },
                    y: 0,
                    opacity: 1,
                    duration: 0.8,
                    delay: index * 0.1,
                    ease: "power3.out",
                    onComplete: () => {
                        const counter = stat.querySelector('.counter');
                        if(counter) {
                            const target = parseInt(counter.getAttribute('data-target'));
                            gsap.to(counter, {
                                innerHTML: target,
                                duration: 2,
                                snap: { innerHTML: 1 },
                                ease: "power2.out"
                            });
                        }
                    }
                });
            });

            // 6. 3D Card Tilt Effect (Vanilla JS)
            const cards = document.querySelectorAll('.product-card');
            cards.forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    
                    const rotateX = ((y - centerY) / centerY) * -5; // Tilt up/down
                    const rotateY = ((x - centerX) / centerX) * 5; // Tilt left/right
                    
                    const content = card.querySelector('div');
                    content.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
                });
                
                card.addEventListener('mouseleave', () => {
                    const content = card.querySelector('div');
                    content.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
                });
            });

        </script>
    </body>
</html>