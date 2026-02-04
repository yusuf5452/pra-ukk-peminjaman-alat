@extends('layouts.peminjam')

@section('header', 'Dashboard Member')

@section('content')
    <!-- Welcome Banner with Image -->
    <div class="relative overflow-hidden rounded-[2rem] bg-dark-900 p-8 mb-8 border border-white/5 shadow-2xl group">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover opacity-30 group-hover:scale-105 transition-transform duration-1000">
            <div class="absolute inset-0 bg-gradient-to-r from-dark-950 via-dark-950/80 to-transparent"></div>
        </div>
        
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <span class="inline-block py-1 px-3 rounded-full bg-adv-500/20 text-adv-500 text-[10px] font-bold uppercase tracking-widest mb-3 border border-adv-500/20">Ready for Adventure?</span>
                <h3 class="text-3xl md:text-4xl font-display font-bold text-white mb-2">Halo, Budi! 🏔️</h3>
                <p class="text-slate-300 max-w-lg">Cuaca sedang bagus untuk mendaki. Cek kelengkapan alatmu dan ajukan peminjaman sekarang.</p>
            </div>
            <a href="#" class="px-6 py-3 bg-white text-dark-950 font-bold rounded-full text-sm hover:bg-brand-500 transition shadow-[0_0_20px_rgba(255,255,255,0.2)] flex items-center gap-2">
                Mulai Pinjam
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>

    <!-- Active Loan Status (Highlight) -->
    <div class="mb-10">
        <h4 class="font-display font-bold text-lg text-white mb-4 flex items-center gap-2">
            Status Peminjaman Aktif
            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
        </h4>
        
        <!-- Condition: Jika ada pinjaman -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Detail Peminjaman -->
            <div class="lg:col-span-2 bg-dark-800/50 border border-brand-500/30 rounded-2xl p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <svg class="w-32 h-32 text-brand-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/></svg>
                </div>

                <div class="flex flex-col md:flex-row gap-6 relative z-10">
                    <div class="flex-1">
                        <div class="text-xs text-slate-400 font-bold uppercase tracking-widest mb-1">Kode Transaksi</div>
                        <div class="text-xl font-mono text-white mb-4">#TRX-882910</div>

                        <div class="space-y-3">
                            <div class="flex justify-between items-center border-b border-white/5 pb-2">
                                <span class="text-slate-400 text-sm">Barang</span>
                                <span class="text-white font-medium">Tenda Eiger 4P, Carrier 60L</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-white/5 pb-2">
                                <span class="text-slate-400 text-sm">Tanggal Pinjam</span>
                                <span class="text-white font-medium">10 Okt 2024</span>
                            </div>
                            <div class="flex justify-between items-center pb-2">
                                <span class="text-slate-400 text-sm">Jatuh Tempo</span>
                                <span class="text-red-400 font-bold">12 Okt 2024 (Besok)</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Countdown / Status Box -->
                    <div class="w-full md:w-48 bg-dark-950/50 rounded-xl p-4 flex flex-col items-center justify-center border border-white/5 text-center">
                        <div class="text-xs text-slate-500 uppercase font-bold mb-2">Sisa Waktu</div>
                        <div class="text-3xl font-display font-bold text-white mb-1">24<span class="text-sm text-slate-500">j</span></div>
                        <div class="text-xs text-brand-500 bg-brand-500/10 px-2 py-1 rounded">Status: Dipinjam</div>
                    </div>
                </div>
            </div>

            <!-- Fines / Denda Box -->
            <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 flex flex-col justify-center items-center text-center">
                <div class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center text-slate-400 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h5 class="text-slate-400 text-sm font-bold uppercase tracking-widest mb-1">Total Denda</h5>
                <div class="text-3xl font-display font-bold text-white mb-2">Rp 0</div>
                <p class="text-xs text-emerald-500">Aman! Kembalikan tepat waktu.</p>
            </div>
        </div>
    </div>

    <!-- Quick Category Selection -->
    <div class="mb-10">
        <div class="flex justify-between items-end mb-6">
            <h4 class="font-display font-bold text-lg text-white">Jelajah Alat Outdoor</h4>
            <a href="{{ route('peminjam.alat.index') }}" class="text-xs font-bold text-adv-500 hover:text-white transition uppercase tracking-wider">Lihat Semua Katalog</a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <!-- Cat 1 -->
            <a href="#" class="group relative overflow-hidden rounded-2xl aspect-[4/3] bg-dark-800 border border-white/5 hover:border-adv-500/50 transition-colors">
                <img src="https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?q=80&w=2070&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-80 group-hover:scale-110 transition-all duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-dark-950/90 to-transparent"></div>
                <div class="absolute bottom-4 left-4">
                    <span class="text-white font-bold text-lg block group-hover:-translate-y-1 transition-transform">Tenda</span>
                    <span class="text-[10px] text-slate-400 uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">12 Tersedia</span>
                </div>
            </a>
            
            <!-- Cat 2 -->
            <a href="#" class="group relative overflow-hidden rounded-2xl aspect-[4/3] bg-dark-800 border border-white/5 hover:border-adv-500/50 transition-colors">
                <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?q=80&w=2070&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-80 group-hover:scale-110 transition-all duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-dark-950/90 to-transparent"></div>
                <div class="absolute bottom-4 left-4">
                    <span class="text-white font-bold text-lg block group-hover:-translate-y-1 transition-transform">Tas Carrier</span>
                    <span class="text-[10px] text-slate-400 uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">8 Tersedia</span>
                </div>
            </a>

            <!-- Cat 3 -->
            <a href="#" class="group relative overflow-hidden rounded-2xl aspect-[4/3] bg-dark-800 border border-white/5 hover:border-adv-500/50 transition-colors">
                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=2070&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-80 group-hover:scale-110 transition-all duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-dark-950/90 to-transparent"></div>
                <div class="absolute bottom-4 left-4">
                    <span class="text-white font-bold text-lg block group-hover:-translate-y-1 transition-transform">Sepatu</span>
                    <span class="text-[10px] text-slate-400 uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">15 Tersedia</span>
                </div>
            </a>

             <!-- Cat 4 -->
            <a href="#" class="group relative overflow-hidden rounded-2xl aspect-[4/3] bg-dark-800 border border-white/5 hover:border-adv-500/50 transition-colors">
                <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?q=80&w=2070&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-80 group-hover:scale-110 transition-all duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-dark-950/90 to-transparent"></div>
                <div class="absolute bottom-4 left-4">
                    <span class="text-white font-bold text-lg block group-hover:-translate-y-1 transition-transform">Lainnya</span>
                    <span class="text-[10px] text-slate-400 uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">Lampu, Masak, dll</span>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent History Table -->
    <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-6">
        <h3 class="font-display font-bold text-lg text-white mb-6">Riwayat Aktivitas</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="text-xs text-slate-500 uppercase border-b border-white/5">
                    <tr>
                        <th class="py-3 font-bold tracking-wider">Tanggal</th>
                        <th class="py-3 font-bold tracking-wider">Alat</th>
                        <th class="py-3 font-bold tracking-wider">Durasi</th>
                        <th class="py-3 font-bold tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr class="border-b border-white/5 hover:bg-white/5 transition">
                        <td class="py-4 text-slate-300">01 Sep 2024</td>
                        <td class="py-4 font-medium text-white">Sepatu Salomon, Trekking Pole</td>
                        <td class="py-4 text-slate-300">2 Hari</td>
                        <td class="py-4"><span class="px-2 py-1 rounded text-[10px] font-bold uppercase bg-brand-500/20 text-brand-500">Selesai</span></td>
                    </tr>
                    <tr class="border-b border-white/5 hover:bg-white/5 transition">
                        <td class="py-4 text-slate-300">15 Agu 2024</td>
                        <td class="py-4 font-medium text-white">Tenda Great Outdoor</td>
                        <td class="py-4 text-slate-300">3 Hari</td>
                        <td class="py-4"><span class="px-2 py-1 rounded text-[10px] font-bold uppercase bg-brand-500/20 text-brand-500">Selesai</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection