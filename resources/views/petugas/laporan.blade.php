@extends('layouts.petugas')

@section('header', 'Laporan Operasional')

@section('content')
    <div x-data="{ 
        dateStart: '', 
        dateEnd: '', 
        reportType: 'peminjaman',
        isExporting: false,
        
        // Simulasi fungsi export
        exportReport(format) {
            this.isExporting = true;
            // Simulasi delay download
            setTimeout(() => {
                this.isExporting = false;
                alert('Laporan ' + this.reportType.toUpperCase() + ' (' + format + ') berhasil diunduh!');
            }, 1500);
        }
    }">

        <!-- PAGE HEADER & FILTER -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-8">
            <div>
                <h3 class="text-2xl font-bold text-white mb-2">Cetak Laporan</h3>
                <p class="text-slate-400 max-w-lg">Pilih jenis laporan dan periode waktu untuk mengunduh data operasional.</p>
            </div>
            
            <!-- Quick Date Filter -->
            <div class="bg-dark-800/50 p-1 rounded-xl flex border border-white/5">
                <button class="px-4 py-2 rounded-lg text-xs font-bold text-white bg-ops-500 shadow-lg transition">Hari Ini</button>
                <button class="px-4 py-2 rounded-lg text-xs font-bold text-slate-400 hover:text-white transition">Minggu Ini</button>
                <button class="px-4 py-2 rounded-lg text-xs font-bold text-slate-400 hover:text-white transition">Bulan Ini</button>
            </div>
        </div>

        <!-- MAIN CONFIGURATION CARD -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left: Configuration Form -->
            <div class="lg:col-span-1">
                <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm sticky top-24">
                    <h4 class="font-bold text-white text-lg mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-ops-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                        Konfigurasi Laporan
                    </h4>

                    <div class="space-y-6">
                        
                        <!-- 1. Jenis Laporan -->
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-3">1. Pilih Jenis Laporan</label>
                            <div class="grid grid-cols-1 gap-3">
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="type" value="peminjaman" x-model="reportType" class="peer sr-only">
                                    <div class="p-4 rounded-xl border border-white/10 bg-dark-900 hover:bg-dark-800 peer-checked:border-ops-500 peer-checked:bg-ops-500/10 transition-all flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-500">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                        </div>
                                        <div>
                                            <span class="block text-sm font-bold text-white">Laporan Peminjaman</span>
                                            <span class="block text-xs text-slate-500">Data transaksi masuk</span>
                                        </div>
                                    </div>
                                </label>
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="type" value="pengembalian" x-model="reportType" class="peer sr-only">
                                    <div class="p-4 rounded-xl border border-white/10 bg-dark-900 hover:bg-dark-800 peer-checked:border-ops-500 peer-checked:bg-ops-500/10 transition-all flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-emerald-500/20 flex items-center justify-center text-emerald-500">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <div>
                                            <span class="block text-sm font-bold text-white">Laporan Pengembalian</span>
                                            <span class="block text-xs text-slate-500">Data barang kembali & denda</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- 2. Periode Waktu -->
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-3">2. Periode Tanggal</label>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="text-[10px] text-slate-400 mb-1 block">Dari</label>
                                    <input x-model="dateStart" type="date" class="w-full bg-dark-900 border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:ring-ops-500 focus:border-ops-500">
                                </div>
                                <div>
                                    <label class="text-[10px] text-slate-400 mb-1 block">Sampai</label>
                                    <input x-model="dateEnd" type="date" class="w-full bg-dark-900 border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:ring-ops-500 focus:border-ops-500">
                                </div>
                            </div>
                        </div>

                        <!-- 3. Action Buttons -->
                        <div class="pt-4 border-t border-white/10">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-3">3. Export Sebagai</label>
                            <div class="flex gap-3">
                                <button @click="exportReport('PDF')" class="flex-1 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl font-bold text-sm transition shadow-lg shadow-red-500/20 flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    PDF
                                </button>
                                <button @click="exportReport('Excel')" class="flex-1 py-3 bg-green-600 hover:bg-green-500 text-white rounded-xl font-bold text-sm transition shadow-lg shadow-green-500/20 flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Excel
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Right: Preview Table -->
            <div class="lg:col-span-2">
                <div class="bg-dark-800/50 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-sm h-full">
                    <div class="p-6 border-b border-white/5 flex justify-between items-center">
                        <h4 class="font-bold text-white text-lg">Preview Data</h4>
                        <span class="text-xs text-slate-500 bg-white/5 px-2 py-1 rounded">5 Data Terakhir</span>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-white/5 text-slate-400 text-xs uppercase font-bold">
                                <tr>
                                    <th class="px-6 py-4">Tanggal</th>
                                    <th class="px-6 py-4">Kode Trx</th>
                                    <th class="px-6 py-4">Pelanggan</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                    <th class="px-6 py-4 text-right">Nominal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                <!-- Row 1 -->
                                <tr class="hover:bg-white/5 transition-colors">
                                    <td class="px-6 py-4 text-slate-400">22 Okt 2024</td>
                                    <td class="px-6 py-4 font-mono text-ops-400">#TRX-8822</td>
                                    <td class="px-6 py-4 text-white font-medium">Rina Wati</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2 py-1 rounded text-[10px] font-bold uppercase bg-yellow-500/10 text-yellow-500">Pending</span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-white">Rp 140.000</td>
                                </tr>
                                <!-- Row 2 -->
                                <tr class="hover:bg-white/5 transition-colors">
                                    <td class="px-6 py-4 text-slate-400">21 Okt 2024</td>
                                    <td class="px-6 py-4 font-mono text-ops-400">#TRX-8821</td>
                                    <td class="px-6 py-4 text-white font-medium">Budi Santoso</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2 py-1 rounded text-[10px] font-bold uppercase bg-blue-500/10 text-blue-500">Active</span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-white">Rp 135.000</td>
                                </tr>
                                <!-- Row 3 -->
                                <tr class="hover:bg-white/5 transition-colors">
                                    <td class="px-6 py-4 text-slate-400">20 Okt 2024</td>
                                    <td class="px-6 py-4 font-mono text-ops-400">#TRX-8820</td>
                                    <td class="px-6 py-4 text-white font-medium">Dimas Anggara</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2 py-1 rounded text-[10px] font-bold uppercase bg-red-500/10 text-red-500">Late</span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-white">Rp 80.000</td>
                                </tr>
                                <!-- Row 4 -->
                                <tr class="hover:bg-white/5 transition-colors opacity-60">
                                    <td class="px-6 py-4 text-slate-400">19 Okt 2024</td>
                                    <td class="px-6 py-4 font-mono text-slate-500">#TRX-8819</td>
                                    <td class="px-6 py-4 text-white font-medium">Siti Aminah</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2 py-1 rounded text-[10px] font-bold uppercase bg-slate-600 text-slate-300">Selesai</span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-white">Rp 45.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Empty State (Hidden by default, show if no data) -->
                    <div class="hidden p-12 text-center">
                        <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <p class="text-slate-400">Tidak ada data untuk periode ini.</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Loading Overlay -->
        <div x-show="isExporting" style="display: none;" class="fixed inset-0 z-50 bg-black/80 flex flex-col items-center justify-center">
            <div class="w-16 h-16 border-4 border-ops-500 border-t-transparent rounded-full animate-spin mb-4"></div>
            <p class="text-white font-bold animate-pulse">Sedang Menyiapkan Dokumen...</p>
        </div>

    </div>
@endsection