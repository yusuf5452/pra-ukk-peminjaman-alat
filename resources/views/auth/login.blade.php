<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - OutdoorRent</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- GSAP -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

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
                                500: '#00dc82', // Vivid Emerald
                                600: '#00b368',
                                400: '#36e59e',
                                accent: '#cdf443',
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
                            'spin-slow': 'spin 20s linear infinite',
                        }
                    }
                }
            }
        </script>

        <style>
            /* Base Reset & Aesthetics matched to Welcome page */
            body { 
                background-color: #030305;
                cursor: default;
            }
            
            ::selection { background: #00dc82; color: #000; }

            .glass-panel {
                background: rgba(255, 255, 255, 0.03);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.08);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            }

            .input-glass {
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                transition: all 0.3s ease;
            }

            .input-glass:focus-within {
                border-color: #00dc82;
                background: rgba(255, 255, 255, 0.08);
                box-shadow: 0 0 15px rgba(0, 220, 130, 0.1);
            }

            /* Custom Checkbox */
            .custom-checkbox input:checked + div {
                background-color: #00dc82;
                border-color: #00dc82;
            }
            .custom-checkbox input:checked + div svg {
                display: block;
            }
        </style>
    </head>
    <body class="font-sans antialiased text-white h-screen flex items-center justify-center overflow-hidden relative">

        <!-- BACKGROUND LAYERS (Sama dengan Welcome) -->
        <div class="fixed inset-0 z-[-2] pointer-events-none">
            <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-dark-950/80 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-dark-950 via-dark-950/60 to-dark-950/80"></div>
        </div>

        <!-- Noise Overlay -->
        <div class="fixed inset-0 z-[-1] pointer-events-none bg-noise opacity-40 mix-blend-overlay"></div>

        <!-- Animated Orbs -->
        <div class="fixed inset-0 z-[-1] pointer-events-none overflow-hidden opacity-40">
            <div class="absolute top-[-20%] right-[-10%] w-[600px] h-[600px] bg-brand-500/10 rounded-full blur-[100px] animate-pulse duration-[8000ms]"></div>
            <div class="absolute bottom-[-20%] left-[-10%] w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[100px] animate-pulse duration-[10000ms]"></div>
        </div>

        <!-- BACK BUTTON -->
        <a href="/" class="absolute top-8 left-8 z-50 group flex items-center gap-2 text-slate-400 hover:text-white transition-colors">
            <div class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center group-hover:border-brand-500 group-hover:bg-brand-500 group-hover:text-dark-950 transition-all">
                <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </div>
            <span class="text-sm font-bold tracking-wider uppercase opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all duration-300">Back Home</span>
        </a>

        <!-- MAIN LOGIN CONTAINER -->
        <div class="w-full max-w-md px-6 relative z-10 perspective-1000">
            
            <!-- Decorative Ring -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] border border-white/5 rounded-full animate-spin-slow pointer-events-none z-[-1]"></div>

            <div id="login-card" class="glass-panel p-8 md:p-10 rounded-[2.5rem] relative transform-style-3d opacity-0 translate-y-10">
                
                <!-- Logo Header -->
                <div class="text-center mb-10">
                    <a href="/" class="inline-flex items-center gap-2 mb-3 group">
                        <div class="w-8 h-8 bg-brand-500 rounded-lg flex items-center justify-center text-dark-950">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                        </div>
                        <span class="font-display font-bold text-xl tracking-tight text-white">Outdoor<span class="text-brand-500">Rent</span>.</span>
                    </a>
                    <h2 class="font-display text-2xl font-bold text-white">Welcome Back</h2>
                    <p class="text-slate-400 text-sm mt-1">Siapkan perlengkapan petualanganmu.</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-brand-500 bg-brand-500/10 p-3 rounded-xl border border-brand-500/20 text-center">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Username Field -->
                    <div class="space-y-2 group">
                        <label for="username" class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Username</label>
                        <div class="input-glass rounded-2xl flex items-center px-4 py-3 gap-3">
                            <svg class="w-5 h-5 text-slate-500 group-focus-within:text-brand-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <input id="username" class="bg-transparent border-none w-full text-white placeholder-slate-500 focus:ring-0 text-sm font-medium outline-none" 
                                   type="text" 
                                   name="username" 
                                   value="{{ old('username') }}" 
                                   required 
                                   autofocus 
                                   autocomplete="username"
                                   placeholder="Masukkan username anda">
                        </div>
                        @if($errors->get('username'))
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $errors->get('username')[0] }}</p>
                        @endif
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2 group">
                        <div class="flex justify-between items-center ml-1">
                            <label for="password" class="text-xs font-bold text-slate-400 uppercase tracking-widest">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs text-brand-500 hover:text-white transition-colors">Lupa Password?</a>
                            @endif
                        </div>
                        <div class="input-glass rounded-2xl flex items-center px-4 py-3 gap-3">
                            <svg class="w-5 h-5 text-slate-500 group-focus-within:text-brand-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <input id="password" class="bg-transparent border-none w-full text-white placeholder-slate-500 focus:ring-0 text-sm font-medium outline-none" 
                                   type="password" 
                                   name="password" 
                                   required 
                                   autocomplete="current-password"
                                   placeholder="••••••••">
                        </div>
                        @if($errors->get('password'))
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $errors->get('password')[0] }}</p>
                        @endif
                    </div>

                    <!-- Remember Me & Actions -->
                    <div class="flex items-center justify-between mt-2">
                        <label class="custom-checkbox flex items-center cursor-pointer group">
                            <input id="remember_me" type="checkbox" name="remember" class="hidden">
                            <div class="w-5 h-5 rounded border border-slate-600 bg-white/5 flex items-center justify-center transition-all group-hover:border-brand-500">
                                <svg class="w-3 h-3 text-dark-950 hidden pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="ml-2 text-sm text-slate-400 group-hover:text-white transition-colors">Ingat Saya</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-brand-500 hover:bg-brand-400 text-dark-950 font-bold py-4 rounded-2xl transition-all transform active:scale-95 shadow-[0_0_20px_rgba(0,220,130,0.3)] hover:shadow-[0_0_30px_rgba(0,220,130,0.5)] flex items-center justify-center gap-2 group">
                        <span>Masuk Sekarang</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-slate-500 text-sm">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-brand-500 font-bold hover:text-white transition-colors">Daftar disini</a>
                    </p>
                </div>
            </div>
        </div>

        <script>
            // Animations matched to Welcome page style
            const tl = gsap.timeline();

            tl.to("#login-card", {
                y: 0,
                opacity: 1,
                duration: 1.2,
                ease: "power4.out",
                delay: 0.2
            })
            .from("form > div", {
                y: 20,
                opacity: 0,
                duration: 0.8,
                stagger: 0.1,
                ease: "power2.out"
            }, "-=0.8");

            // 3D Tilt Effect on Login Card
            const card = document.getElementById('login-card');
            
            document.addEventListener('mousemove', (e) => {
                if(window.innerWidth > 768) { // Only on desktop
                    const x = (window.innerWidth / 2 - e.pageX) / 50;
                    const y = (window.innerHeight / 2 - e.pageY) / 50;
                    
                    gsap.to(card, {
                        rotationY: x,
                        rotationX: y,
                        duration: 1,
                        ease: "power2.out"
                    });
                }
            });
        </script>
    </body>
</html>