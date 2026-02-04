@extends('layouts.admin')

@section('header', 'Pusat Laporan')

@section('content')
    <div x-data="{ 
        dateStart: '', 
        dateEnd: '', 
        selectedType: 'all',
        isExporting: false,
        
        // Simulasi fungsi export
        exportReport(type, format) {
            this.isExporting = true;
            // Simulasi delay download
            setTimeout(() => {
                this.isExporting = false;
                alert('Laporan ' + type + ' (' + format + ') berhasil diunduh!');
            }, 1500);
        }
    }">

        <!-- FILTER SECTION -->
        <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 mb-8 backdrop-blur-sm">
            <h3 class="text-white font-bold text-lg mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                Filter Data
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Date Range -->
                <div class="md:col-span-2 grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs text-slate-400 mb-1">Dari Tanggal</label>
                        <input x-model="dateStart" type="date" class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:ring-brand-500 focus:border-brand-500">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1">Sampai Tanggal</label>
                        <input x-model="dateEnd" type="date" class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:ring-brand-500 focus:border-brand-500">
                    </div>
                </div>

                <!-- User Filter -->
                <div>
                    <label class="block text-xs text-slate-400 mb-1">Filter User</label>
                    <select class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:ring-brand-500 focus:border-brand-500">
                        <option value="">Semua User</option>
                        <option value="1">Rina Wati</option>
                        <option value="2">Budi Santoso</option>
                        <option value="3">Siti Aminah</option>
                    </select>
                </div>

                <!-- Alat Filter -->
                <div>
                    <label class="block text-xs text-slate-400 mb-1">Filter Alat</label>
                    <select class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:ring-brand-500 focus:border-brand-500">
                        <option value="">Semua Alat</option>
                        <option value="tenda">Tenda</option>
                        <option value="carrier">Carrier</option>
                        <option value="sepatu">Sepatu</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- REPORT CARDS GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            
            <!-- 1. Laporan Peminjaman -->
            <div class="bg-gradient-to-br from-dark-800 to-dark-900 border border-white/5 rounded-2xl p-6 relative overflow-hidden group hover:border-brand-500/30 transition-all">
                <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                    <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                </div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-500 mb-4 border border-blue-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-1">Laporan Peminjaman</h3>
                    <p class="text-sm text-slate-400 mb-6">Rekapitulasi data peminjaman barang masuk dan keluar beserta statusnya.</p>
                    
                    <div class="flex gap-3">
                        <button @click="exportReport('Peminjaman', 'PDF')" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-xl transition-all font-bold text-sm border border-red-500/20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            PDF
                        </button>
                        <button @click="exportReport('Peminjaman', 'Excel')" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-green-500/10 hover:bg-green-500 text-green-500 hover:text-white rounded-xl transition-all font-bold text-sm border border-green-500/20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Excel
                        </button>
                    </div>
                </div>
            </div>

            <!-- 2. Laporan Pengembalian -->
            <div class="bg-gradient-to-br from-dark-800 to-dark-900 border border-white/5 rounded-2xl p-6 relative overflow-hidden group hover:border-brand-500/30 transition-all">
                <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                    <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-purple-500/10 flex items-center justify-center text-purple-500 mb-4 border border-purple-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-1">Laporan Pengembalian</h3>
                    <p class="text-sm text-slate-400 mb-6">Data barang kembali, kondisi barang (baik/rusak), dan ketepatan waktu.</p>
                    
                    <div class="flex gap-3">
                        <button @click="exportReport('Pengembalian', 'PDF')" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-xl transition-all font-bold text-sm border border-red-500/20">
                            PDF
                        </button>
                        <button @click="exportReport('Pengembalian', 'Excel')" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-green-500/10 hover:bg-green-500 text-green-500 hover:text-white rounded-xl transition-all font-bold text-sm border border-green-500/20">
                            Excel
                        </button>
                    </div>
                </div>
            </div>

            <!-- 3. Laporan Pendapatan -->
            <div class="bg-gradient-to-br from-dark-800 to-dark-900 border border-white/5 rounded-2xl p-6 relative overflow-hidden group hover:border-brand-500/30 transition-all">
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-brand-500/10 flex items-center justify-center text-brand-500 mb-4 border border-brand-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-1">Laporan Pendapatan</h3>
                    <p class="text-sm text-slate-400 mb-6">Analisis pemasukan dari sewa alat per periode, kategori, atau item terlaris.</p>
                    
                    <div class="flex gap-3">
                        <button @click="exportReport('Pendapatan', 'PDF')" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-xl transition-all font-bold text-sm border border-red-500/20">
                            PDF
                        </button>
                        <button @click="exportReport('Pendapatan', 'Excel')" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-green-500/10 hover:bg-green-500 text-green-500 hover:text-white rounded-xl transition-all font-bold text-sm border border-green-500/20">
                            Excel
                        </button>
                    </div>
                </div>
            </div>

            <!-- 4. Laporan Denda -->
            <div class="bg-gradient-to-br from-dark-800 to-dark-900 border border-white/5 rounded-2xl p-6 relative overflow-hidden group hover:border-brand-500/30 transition-all">
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-orange-500/10 flex items-center justify-center text-orange-500 mb-4 border border-orange-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-1">Laporan Denda</h3>
                    <p class="text-sm text-slate-400 mb-6">Rekap denda keterlambatan dan biaya ganti rugi kerusakan alat.</p>
                    
                    <div class="flex gap-3">
                        <button @click="exportReport('Denda', 'PDF')" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-xl transition-all font-bold text-sm border border-red-500/20">
                            PDF
                        </button>
                        <button @click="exportReport('Denda', 'Excel')" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-green-500/10 hover:bg-green-500 text-green-500 hover:text-white rounded-xl transition-all font-bold text-sm border border-green-500/20">
                            Excel
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- Preview Table (Optional) -->
        <div class="bg-dark-800/50 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-sm">
            <div class="p-6 border-b border-white/5">
                <h3 class="text-lg font-bold text-white">Preview Data Terkini</h3>
                <p class="text-xs text-slate-500">5 Transaksi terakhir yang akan masuk dalam laporan.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-white/5 text-xs uppercase text-slate-400 font-bold">
                        <tr>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">User</th>
                            <th class="px-6 py-4">Jenis</th>
                            <th class="px-6 py-4 text-right">Nominal</th>
                            <th class="px-6 py-4 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 text-slate-300">20 Okt 2024</td>
                            <td class="px-6 py-4 font-bold text-white">Rina Wati</td>
                            <td class="px-6 py-4 text-blue-400">Peminjaman</td>
                            <td class="px-6 py-4 text-right text-white">Rp 150.000</td>
                            <td class="px-6 py-4 text-center"><span class="px-2 py-1 bg-green-500/10 text-green-500 rounded text-xs font-bold">Lunas</span></td>
                        </tr>
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 text-slate-300">19 Okt 2024</td>
                            <td class="px-6 py-4 font-bold text-white">Budi Santoso</td>
                            <td class="px-6 py-4 text-orange-400">Denda Telat</td>
                            <td class="px-6 py-4 text-right text-white">Rp 50.000</td>
                            <td class="px-6 py-4 text-center"><span class="px-2 py-1 bg-yellow-500/10 text-yellow-500 rounded text-xs font-bold">Pending</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Loading Overlay -->
        <div x-show="isExporting" style="display: none;" class="fixed inset-0 z-50 bg-black/80 flex flex-col items-center justify-center">
            <div class="w-16 h-16 border-4 border-brand-500 border-t-transparent rounded-full animate-spin mb-4"></div>
            <p class="text-white font-bold animate-pulse">Sedang Membuat Laporan...</p>
        </div>

    </div>
@endsection