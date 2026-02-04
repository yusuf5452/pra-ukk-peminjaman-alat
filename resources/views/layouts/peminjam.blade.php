<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OutdoorRent') }} - Member Area</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Space Grotesk"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            500: '#00dc82',
                        },
                        // Warna khusus Peminjam/Pendaki (Adventure Orange)
                        adv: {
                            500: '#f97316', 
                            600: '#ea580c',
                            400: '#fb923c',
                        },
                        dark: {
                            950: '#030305',
                            900: '#0c0c0e',
                            800: '#16161a',
                            700: '#1e1e24',
                        }
                    },
                    backgroundImage: {
                        'noise': "url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22 opacity=%220.05%22/%3E%3C/svg%3E')",
                    }
                }
            }
        }
    </script>

    <style>
        body { background-color: #030305; }
        
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #0c0c0e; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #f97316; }

        .glass-sidebar {
            background: rgba(12, 12, 14, 0.95);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .glass-header {
            background: rgba(3, 3, 5, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .nav-item {
            transition: all 0.2s;
        }
        
        .nav-item.active {
            background: rgba(249, 115, 22, 0.1); /* Orange tint */
            border-left: 3px solid #f97316;
            color: #fff;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.03);
            color: white;
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-300 selection:bg-adv-500 selection:text-white overflow-hidden">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-dark-950 relative">

        <!-- OVERLAY (Mobile) -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-black/80 z-40 lg:hidden"></div>

        <!-- SIDEBAR -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 glass-sidebar transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 flex flex-col">
            
            <!-- Logo Area -->
            <div class="flex items-center justify-center h-20 border-b border-white/5 bg-gradient-to-r from-adv-900/20 to-transparent">
                <a href="{{ route('peminjam.dashboard') }}" class="flex items-center gap-2 group">
                    <div class="w-8 h-8 bg-adv-500 rounded-lg flex items-center justify-center text-white transform group-hover:rotate-12 transition-transform shadow-[0_0_15px_rgba(249,115,22,0.5)]">
                        <!-- Icon Gunung/Tenda -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-display font-bold text-lg text-white tracking-tight">PEMINJAM<span class="text-adv-500">PANEL</span>.</span>
                    </div>
                </a>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 overflow-y-auto py-6 px-0 space-y-1">
                
                <!-- Dashboard -->
                <a href="{{ route('peminjam.dashboard') }}" class="nav-item {{ request()->routeIs('peminjam.dashboard') ? 'active' : '' }} flex items-center gap-3 px-6 py-3 text-sm font-medium border-l-4 border-transparent">
                    <svg class="w-5 h-5 text-adv-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>

                <div class="px-6 mt-6 mb-2">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-600">Eksplorasi & Peminjaman</p>
                </div>

                <!-- Daftar Alat -->
                <a href="{{ route('peminjam.alat.index') }}" class="nav-item {{ request()->routeIs('peminjam.alat*') ? 'active' : '' }} flex items-center gap-3 px-6 py-3 text-sm font-medium border-l-4 border-transparent hover:text-white group">
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-adv-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    <span>Daftar Alat</span>
                </a>

                <!-- Ajukan Peminjaman -->
                <a href="{{ route('peminjam.pengajuan.index') }}" class="nav-item {{ request()->routeIs('peminjam.pengajuan*') ? 'active' : '' }} flex items-center gap-3 px-6 py-3 text-sm font-medium border-l-4 border-transparent hover:text-white group">
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-adv-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Ajukan Peminjaman</span>
                </a>

                <div class="px-6 mt-6 mb-2">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-600">Aktivitas Saya</p>
                </div>

                <!-- Riwayat Peminjaman -->
                <a href="{{ route('peminjam.riwayat.index') }}" class="nav-item {{ request()->routeIs('peminjam.riwayat*') ? 'active' : '' }} flex items-center gap-3 px-6 py-3 text-sm font-medium border-l-4 border-transparent hover:text-white group">
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-adv-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    <span>Riwayat Peminjaman</span>
                </a>

                <!-- Pengembalian Alat -->
                <a href="{{ route('peminjam.pengembalian.index') }}" class="nav-item {{ request()->routeIs('peminjam.pengembalian*') ? 'active' : '' }} flex items-center gap-3 px-6 py-3 text-sm font-medium border-l-4 border-transparent hover:text-white group">
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-adv-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    <span>Pengembalian Alat</span>
                </a>

            </nav>

            <!-- Profil & Logout (Bottom) -->
            <div x-data="{ open: false }" class="border-t border-white/5 bg-black/20">
                <div class="p-4">
                    <button @click="open = !open" class="flex items-center gap-3 w-full group">
                        <div class="relative">
                             <img class="h-10 w-10 rounded-full object-cover border border-adv-500/50 group-hover:border-adv-500 transition" src="https://ui-avatars.com/api/?name=Pendaki+Gunung&background=f97316&color=ffffff" alt="Member" />
                             <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-adv-500 border-2 border-dark-900 rounded-full"></span>
                        </div>
                        <div class="flex-1 min-w-0 text-left">
                            <p class="text-sm font-bold text-white truncate group-hover:text-adv-500 transition">Pendaki Gunung</p>
                            <p class="text-xs text-slate-500 truncate">Member Basic</p>
                        </div>
                        <svg class="w-4 h-4 text-slate-500 group-hover:text-white" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                    </button>
                    
                    <!-- Upwards Collapse for Profile Menu -->
                    <div x-show="open" x-transition class="mt-4 pt-4 border-t border-white/5 space-y-2">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 text-xs font-medium text-slate-400 hover:text-white px-2 py-1 rounded hover:bg-white/5 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Edit Profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 text-xs font-medium text-red-400 hover:text-red-300 px-2 py-1 rounded hover:bg-red-500/10 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT WRAPPER -->
        <div class="flex-1 flex flex-col overflow-hidden relative">
            <div class="absolute inset-0 z-[-1] pointer-events-none bg-noise opacity-30 mix-blend-overlay"></div>

            <!-- HEADER -->
            <header class="glass-header h-20 flex items-center justify-between px-6 z-30 sticky top-0">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden text-slate-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h2 class="font-display font-bold text-xl text-white tracking-tight">
                        @yield('header', 'Dashboard')
                    </h2>
                </div>
                <!-- Notif Icon -->
                <button class="relative p-2 text-slate-400 hover:text-white transition-colors">
                     <span class="absolute top-2 right-2 w-2 h-2 bg-adv-500 rounded-full animate-ping"></span>
                     <span class="absolute top-2 right-2 w-2 h-2 bg-adv-500 rounded-full"></span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                </button>
            </header>

            <!-- MAIN CONTENT AREA -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-dark-950/50 p-6 md:p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>