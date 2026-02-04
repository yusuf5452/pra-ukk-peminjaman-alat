@extends('layouts.admin')

@section('header', 'Overview Dashboard')

@section('content')
    <!-- Welcome Banner -->
    <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-brand-600 to-emerald-800 p-8 mb-8 shadow-2xl">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/20 rounded-full blur-2xl"></div>
        <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-black/10 rounded-full blur-xl"></div>
        
        <div class="relative z-10 flex justify-between items-end">
            <div>
                <h3 class="text-3xl font-display font-bold text-white mb-2">Halo, Administrator! 👋</h3>
                <p class="text-emerald-100 max-w-xl">Laporan harian sistem OutdoorRent. Cek status peminjaman dan ketersediaan alat hari ini.</p>
            </div>
            <div class="hidden md:block">
                <button class="px-5 py-2 bg-white text-emerald-700 font-bold rounded-full text-sm hover:bg-emerald-50 transition shadow-lg">
                    Unduh Laporan
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <!-- Card 1: Total User -->
        <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 hover:border-brand-500/30 transition-colors group">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-blue-500/10 rounded-xl text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Users</span>
            </div>
            <div class="text-3xl font-display font-bold text-white mb-1">1,240</div>
            <p class="text-sm text-slate-400">Total pengguna terdaftar</p>
        </div>

        <!-- Card 2: Total Alat -->
        <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 hover:border-brand-500/30 transition-colors group">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-brand-500/10 rounded-xl text-brand-500 group-hover:bg-brand-500 group-hover:text-dark-950 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Inventory</span>
            </div>
            <div class="text-3xl font-display font-bold text-white mb-1">458</div>
            <p class="text-sm text-slate-400">Unit alat tersedia</p>
        </div>

        <!-- Card 3: Peminjaman Aktif -->
        <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 hover:border-brand-500/30 transition-colors group">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-orange-500/10 rounded-xl text-orange-500 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Active Loans</span>
            </div>
            <div class="text-3xl font-display font-bold text-white mb-1">24</div>
            <p class="text-sm text-slate-400">Sedang dipinjam saat ini</p>
        </div>

        <!-- Card 4: Alat Rusak -->
        <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 hover:border-brand-500/30 transition-colors group">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-red-500/10 rounded-xl text-red-500 group-hover:bg-red-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Maintenance</span>
            </div>
            <div class="text-3xl font-display font-bold text-white mb-1">5</div>
            <p class="text-sm text-slate-400">Butuh perbaikan segera</p>
        </div>
    </div>

    <!-- Content Split: Recent Activity & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left: Recent Loans (Placeholder Table) -->
        <div class="lg:col-span-2 bg-dark-800/50 border border-white/5 rounded-2xl p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-display font-bold text-lg text-white">Peminjaman Terakhir</h3>
                <a href="#" class="text-xs font-bold text-brand-500 hover:text-white transition uppercase tracking-wider">Lihat Semua</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-xs text-slate-500 uppercase border-b border-white/5">
                            <th class="py-3 font-bold tracking-wider">Peminjam</th>
                            <th class="py-3 font-bold tracking-wider">Alat</th>
                            <th class="py-3 font-bold tracking-wider">Tanggal Kembali</th>
                            <th class="py-3 font-bold tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-slate-300">
                        <tr class="border-b border-white/5 hover:bg-white/5 transition">
                            <td class="py-4 font-medium text-white">Budi Santoso</td>
                            <td class="py-4">Tenda Eiger 4P</td>
                            <td class="py-4">12 Okt 2024</td>
                            <td class="py-4"><span class="px-2 py-1 rounded text-[10px] font-bold uppercase bg-yellow-500/20 text-yellow-500">Dipinjam</span></td>
                        </tr>
                        <tr class="border-b border-white/5 hover:bg-white/5 transition">
                            <td class="py-4 font-medium text-white">Siti Aminah</td>
                            <td class="py-4">Carrier Osprey 60L</td>
                            <td class="py-4">10 Okt 2024</td>
                            <td class="py-4"><span class="px-2 py-1 rounded text-[10px] font-bold uppercase bg-brand-500/20 text-brand-500">Selesai</span></td>
                        </tr>
                         <tr class="border-b border-white/5 hover:bg-white/5 transition">
                            <td class="py-4 font-medium text-white">Joko Anwar</td>
                            <td class="py-4">Sepatu Salomon (42)</td>
                            <td class="py-4">08 Okt 2024</td>
                            <td class="py-4"><span class="px-2 py-1 rounded text-[10px] font-bold uppercase bg-red-500/20 text-red-500">Telat</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right: Quick Actions -->
        <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 h-fit">
            <h3 class="font-display font-bold text-lg text-white mb-6">Aksi Cepat</h3>
            <div class="space-y-3">
                <button class="w-full flex items-center justify-between p-4 bg-white/5 hover:bg-brand-500 hover:text-dark-950 rounded-xl transition-all group border border-white/5">
                    <span class="font-bold text-sm">Tambah Peminjaman</span>
                    <svg class="w-5 h-5 opacity-50 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </button>
                <button class="w-full flex items-center justify-between p-4 bg-white/5 hover:bg-white/10 rounded-xl transition-all group border border-white/5">
                    <span class="font-bold text-sm text-slate-300 group-hover:text-white">Input Barang Baru</span>
                    <svg class="w-5 h-5 text-slate-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </button>
                <button class="w-full flex items-center justify-between p-4 bg-white/5 hover:bg-white/10 rounded-xl transition-all group border border-white/5">
                    <span class="font-bold text-sm text-slate-300 group-hover:text-white">Cetak Laporan Bulanan</span>
                    <svg class="w-5 h-5 text-slate-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                </button>
            </div>
        </div>

    </div>
@endsection