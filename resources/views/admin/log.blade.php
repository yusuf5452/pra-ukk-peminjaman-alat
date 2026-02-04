@extends('layouts.admin')

@section('header', 'Log Aktivitas Sistem')

@section('content')
    <div x-data="{ 
        activeFilter: 'all',
        search: ''
    }">

        <!-- Quick Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Card 1: Total Aktivitas Hari Ini -->
            <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-500 border border-blue-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Aktivitas Hari Ini</p>
                    <p class="text-2xl font-bold text-white">142 <span class="text-xs text-blue-400 font-normal">Logs</span></p>
                </div>
            </div>

            <!-- Card 2: User Login -->
            <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-500 border border-emerald-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                </div>
                <div>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Login Berhasil</p>
                    <p class="text-2xl font-bold text-white">24 <span class="text-xs text-emerald-400 font-normal">Users</span></p>
                </div>
            </div>

            <!-- Card 3: Perubahan Data (CRUD) -->
            <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-orange-500/10 flex items-center justify-center text-orange-500 border border-orange-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                </div>
                <div>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Perubahan Data</p>
                    <p class="text-2xl font-bold text-white">8 <span class="text-xs text-orange-400 font-normal">Actions</span></p>
                </div>
            </div>
        </div>

        <!-- FILTER & SEARCH -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
            <!-- Filter Types -->
            <div class="flex bg-dark-900 p-1 rounded-xl border border-white/5 overflow-x-auto max-w-full">
                <button @click="activeFilter = 'all'" :class="activeFilter === 'all' ? 'bg-brand-500 text-dark-950 font-bold shadow-lg' : 'text-slate-400 hover:text-white'" class="px-4 py-2 rounded-lg text-xs transition-all whitespace-nowrap">Semua</button>
                <button @click="activeFilter = 'auth'" :class="activeFilter === 'auth' ? 'bg-brand-500 text-dark-950 font-bold shadow-lg' : 'text-slate-400 hover:text-white'" class="px-4 py-2 rounded-lg text-xs transition-all whitespace-nowrap">Login/Logout</button>
                <button @click="activeFilter = 'crud'" :class="activeFilter === 'crud' ? 'bg-brand-500 text-dark-950 font-bold shadow-lg' : 'text-slate-400 hover:text-white'" class="px-4 py-2 rounded-lg text-xs transition-all whitespace-nowrap">Data (CRUD)</button>
                <button @click="activeFilter = 'system'" :class="activeFilter === 'system' ? 'bg-brand-500 text-dark-950 font-bold shadow-lg' : 'text-slate-400 hover:text-white'" class="px-4 py-2 rounded-lg text-xs transition-all whitespace-nowrap">System</button>
            </div>

            <!-- Search -->
            <div class="relative group w-full md:w-64">
                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-slate-500 group-focus-within:text-brand-500 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input x-model="search" type="text" placeholder="Cari user, aktivitas..." class="bg-dark-800/50 border border-white/10 text-white text-sm rounded-xl focus:ring-brand-500 focus:border-brand-500 block w-full pl-10 p-2.5 placeholder-slate-500 transition-all">
            </div>
        </div>

        <!-- LOG LIST TABLE -->
        <div class="bg-dark-800/50 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-white/5 text-xs uppercase text-slate-400 font-bold">
                        <tr>
                            <th class="px-6 py-4">Waktu</th>
                            <th class="px-6 py-4">User (Aktor)</th>
                            <th class="px-6 py-4">Tipe</th>
                            <th class="px-6 py-4">Aktivitas & Detail</th>
                            <th class="px-6 py-4 text-right">IP Address</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-sm">
                        
                        <!-- Log Item 1: Login (Auth) -->
                        <tr x-show="activeFilter === 'all' || activeFilter === 'auth'" class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-4 text-slate-400 whitespace-nowrap">
                                20 Okt, 14:30
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-brand-500 flex items-center justify-center text-dark-950 font-bold text-xs">AD</div>
                                    <span class="text-white font-bold">Admin System</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-[10px] font-bold uppercase bg-emerald-500/10 text-emerald-500 border border-emerald-500/20">Login</span>
                            </td>
                            <td class="px-6 py-4 text-slate-300">
                                Berhasil login ke Admin Panel
                            </td>
                            <td class="px-6 py-4 text-right font-mono text-slate-500 text-xs">
                                192.168.1.10
                            </td>
                        </tr>

                        <!-- Log Item 2: Update Data (CRUD) -->
                        <tr x-show="activeFilter === 'all' || activeFilter === 'crud'" class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-4 text-slate-400 whitespace-nowrap">
                                20 Okt, 14:15
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-xs">BU</div>
                                    <span class="text-white font-bold">Petugas Budi</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-[10px] font-bold uppercase bg-orange-500/10 text-orange-500 border border-orange-500/20">Update</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-white font-medium">Update Status Peminjaman</span>
                                <div class="text-xs text-slate-500 mt-1">Mengubah status transaksi <span class="font-mono text-brand-500">#TRX-8820</span> dari <span class="text-yellow-500">Pending</span> ke <span class="text-blue-500">Disetujui</span></div>
                            </td>
                            <td class="px-6 py-4 text-right font-mono text-slate-500 text-xs">
                                192.168.1.25
                            </td>
                        </tr>

                        <!-- Log Item 3: Delete Data (CRUD - Warning) -->
                        <tr x-show="activeFilter === 'all' || activeFilter === 'crud'" class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-4 text-slate-400 whitespace-nowrap">
                                20 Okt, 13:00
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-brand-500 flex items-center justify-center text-dark-950 font-bold text-xs">AD</div>
                                    <span class="text-white font-bold">Admin System</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-[10px] font-bold uppercase bg-red-500/10 text-red-500 border border-red-500/20">Delete</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-white font-medium">Menghapus Alat</span>
                                <div class="text-xs text-slate-500 mt-1">Menghapus data alat "Tenda Lama (Rusak)" - ID: 12</div>
                            </td>
                            <td class="px-6 py-4 text-right font-mono text-slate-500 text-xs">
                                192.168.1.10
                            </td>
                        </tr>

                        <!-- Log Item 4: System Event -->
                        <tr x-show="activeFilter === 'all' || activeFilter === 'system'" class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-4 text-slate-400 whitespace-nowrap">
                                20 Okt, 00:00
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-white font-bold text-xs">SYS</div>
                                    <span class="text-slate-400 font-bold italic">System Auto</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-[10px] font-bold uppercase bg-purple-500/10 text-purple-500 border border-purple-500/20">Cron Job</span>
                            </td>
                            <td class="px-6 py-4 text-slate-300">
                                Pengecekan denda harian selesai. 2 Peminjaman ditandai terlambat.
                            </td>
                            <td class="px-6 py-4 text-right font-mono text-slate-500 text-xs">
                                localhost
                            </td>
                        </tr>

                        <!-- Log Item 5: Logout -->
                        <tr x-show="activeFilter === 'all' || activeFilter === 'auth'" class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-4 text-slate-400 whitespace-nowrap">
                                19 Okt, 21:00
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-xs">BU</div>
                                    <span class="text-white font-bold">Petugas Budi</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-[10px] font-bold uppercase bg-slate-500/10 text-slate-400 border border-slate-500/20">Logout</span>
                            </td>
                            <td class="px-6 py-4 text-slate-300">
                                Logout dari sistem
                            </td>
                            <td class="px-6 py-4 text-right font-mono text-slate-500 text-xs">
                                192.168.1.25
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="p-4 border-t border-white/5 flex justify-between items-center text-xs text-slate-500">
                <span>Menampilkan 1-5 dari 142 log</span>
                <div class="flex gap-2">
                    <button class="px-3 py-1 bg-white/5 hover:bg-white/10 rounded text-slate-300 disabled:opacity-50">Previous</button>
                    <button class="px-3 py-1 bg-brand-500 text-dark-950 font-bold rounded">1</button>
                    <button class="px-3 py-1 bg-white/5 hover:bg-white/10 rounded text-slate-300">2</button>
                    <button class="px-3 py-1 bg-white/5 hover:bg-white/10 rounded text-slate-300">3</button>
                    <button class="px-3 py-1 bg-white/5 hover:bg-white/10 rounded text-slate-300">Next</button>
                </div>
            </div>
        </div>

    </div>
@endsection