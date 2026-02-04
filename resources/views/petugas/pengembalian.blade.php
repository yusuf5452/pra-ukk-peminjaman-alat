@extends('layouts.petugas')

@section('header', 'Monitoring Pengembalian')

@section('content')
    <div x-data="{ 
        showProcessModal: false,
        activeFilter: 'upcoming',
        search: '',
        
        // Data Simulasi untuk Modal
        selectedTrx: null,
        lateDays: 0,
        finePerDay: 50000,
        damageCost: 0,
        
        // Fungsi helper hitung total
        get totalFine() {
            return (this.lateDays * this.finePerDay) + parseInt(this.damageCost || 0);
        },

        openProcessModal(trx, daysLate) {
            this.selectedTrx = trx;
            this.lateDays = daysLate;
            this.damageCost = 0;
            this.showProcessModal = true;
        }
    }">

        <!-- Top Action Bar -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
            
            <!-- Filters -->
            <div class="bg-dark-800/50 p-1 rounded-xl flex border border-white/5 overflow-x-auto max-w-full">
                <button @click="activeFilter = 'upcoming'" 
                    :class="activeFilter === 'upcoming' ? 'bg-ops-500 text-white shadow-lg' : 'text-slate-400 hover:text-white'"
                    class="px-6 py-2 rounded-lg text-sm font-bold transition-all whitespace-nowrap">
                    Akan Kembali
                </button>
                <button @click="activeFilter = 'late'" 
                    :class="activeFilter === 'late' ? 'bg-red-500 text-white shadow-lg' : 'text-slate-400 hover:text-white'"
                    class="px-6 py-2 rounded-lg text-sm font-bold transition-all whitespace-nowrap">
                    Terlambat
                </button>
                <button @click="activeFilter = 'history'" 
                    :class="activeFilter === 'history' ? 'bg-slate-600 text-white shadow-lg' : 'text-slate-400 hover:text-white'"
                    class="px-6 py-2 rounded-lg text-sm font-bold transition-all whitespace-nowrap">
                    Riwayat Selesai
                </button>
            </div>

            <!-- Search -->
            <div class="relative group w-full md:w-64">
                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-slate-500 group-focus-within:text-ops-500 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input x-model="search" type="text" placeholder="Cari peminjam..." class="bg-dark-800/50 border border-white/10 text-white text-sm rounded-xl focus:ring-ops-500 focus:border-ops-500 block w-full pl-10 p-2.5 placeholder-slate-500 transition-all">
            </div>
        </div>

        <!-- LIST OF RETURNS -->
        <div class="space-y-4">

            <!-- Item 1: Due Soon (Normal) -->
            <div x-show="activeFilter === 'upcoming' || activeFilter === 'all'" class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 hover:border-ops-500/30 transition-all group relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-ops-500"></div>
                <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-6">
                    <!-- Info Peminjam -->
                    <div class="flex items-center gap-4 min-w-[250px]">
                        <div class="h-12 w-12 rounded-xl bg-dark-900 flex items-center justify-center text-ops-500 font-bold border border-white/10">
                            H-0
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-lg">Budi Santoso</h4>
                            <p class="text-sm text-slate-400 font-mono">#TRX-8820</p>
                        </div>
                    </div>

                    <!-- Items -->
                    <div class="flex-1">
                        <p class="text-xs text-slate-500 uppercase font-bold mb-1">Barang Kembali</p>
                        <p class="text-white text-sm">Carrier Osprey 60L, Tenda Eiger 2P</p>
                    </div>

                    <!-- Time -->
                    <div class="min-w-[150px]">
                        <p class="text-xs text-slate-500 uppercase font-bold mb-1">Batas Waktu</p>
                        <p class="text-white font-bold">Hari Ini, 17:00</p>
                    </div>

                    <!-- Action -->
                    <div>
                        <button @click="openProcessModal('#TRX-8820', 0)" class="px-5 py-2.5 bg-ops-600 hover:bg-ops-500 text-white rounded-xl text-sm font-bold transition shadow-lg shadow-ops-500/20 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Proses Kembali
                        </button>
                    </div>
                </div>
            </div>

            <!-- Item 2: Overdue (Late) -->
            <div x-show="activeFilter === 'late' || activeFilter === 'all'" class="bg-dark-800/50 border border-red-500/30 rounded-2xl p-6 hover:bg-red-500/5 transition-all group relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-red-500"></div>
                <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-6">
                    <div class="flex items-center gap-4 min-w-[250px]">
                        <div class="h-12 w-12 rounded-xl bg-red-500/10 flex items-center justify-center text-red-500 font-bold border border-red-500/20">
                            -2H
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-lg">Dimas Anggara</h4>
                            <p class="text-sm text-slate-400 font-mono">#TRX-8815</p>
                        </div>
                    </div>

                    <div class="flex-1">
                        <p class="text-xs text-slate-500 uppercase font-bold mb-1">Barang Kembali</p>
                        <p class="text-white text-sm">Sepatu Hiking (42)</p>
                    </div>

                    <div class="min-w-[150px]">
                        <p class="text-xs text-slate-500 uppercase font-bold mb-1">Status</p>
                        <p class="text-red-400 font-bold">Telat 2 Hari</p>
                    </div>

                    <div>
                        <button @click="openProcessModal('#TRX-8815', 2)" class="px-5 py-2.5 bg-red-600 hover:bg-red-500 text-white rounded-xl text-sm font-bold transition shadow-lg shadow-red-500/20 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Hitung Denda
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- ================= PROCESS RETURN MODAL ================= -->
        <div x-show="showProcessModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showProcessModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-black/80 transition-opacity" @click="showProcessModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                
                <div class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl w-full">
                    <form action="#" method="POST"> <!-- Route Complete Return -->
                        @csrf
                        
                        <!-- Header -->
                        <div class="bg-dark-800 p-6 border-b border-white/5 flex justify-between items-center">
                            <div>
                                <h3 class="text-xl font-bold text-white">Konfirmasi Pengembalian</h3>
                                <p class="text-sm text-slate-400">Transaksi <span class="font-mono text-ops-400" x-text="selectedTrx"></span></p>
                            </div>
                            <button type="button" @click="showProcessModal = false" class="text-slate-400 hover:text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                        </div>

                        <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
                            
                            <!-- Left: Item Checklist -->
                            <div class="lg:col-span-2 space-y-6">
                                
                                <!-- Step 1: Cek Kondisi -->
                                <div>
                                    <div class="flex items-center justify-between mb-4">
                                        <h4 class="text-sm font-bold text-white uppercase tracking-wider">1. Cek Fisik Barang</h4>
                                        <span class="text-[10px] bg-white/10 text-slate-300 px-2 py-1 rounded">Wajib Diisi</span>
                                    </div>
                                    
                                    <div class="space-y-3">
                                        <!-- Item Row 1 -->
                                        <div class="bg-dark-950 border border-white/5 rounded-xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded bg-dark-800 flex items-center justify-center border border-white/10 text-slate-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-bold text-white">Carrier Osprey 60L</p>
                                                    <p class="text-xs text-slate-500">ID: A-001</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="condition_1" value="good" class="peer sr-only" checked>
                                                    <div class="px-3 py-1.5 rounded-lg border border-white/10 text-slate-400 text-xs font-bold peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:border-emerald-500 transition">Baik</div>
                                                </label>
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="condition_1" value="damaged" class="peer sr-only">
                                                    <div class="px-3 py-1.5 rounded-lg border border-white/10 text-slate-400 text-xs font-bold peer-checked:bg-yellow-500 peer-checked:text-dark-950 peer-checked:border-yellow-500 transition">Rusak</div>
                                                </label>
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="condition_1" value="lost" class="peer sr-only">
                                                    <div class="px-3 py-1.5 rounded-lg border border-white/10 text-slate-400 text-xs font-bold peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 transition">Hilang</div>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Item Row 2 -->
                                        <div class="bg-dark-950 border border-white/5 rounded-xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded bg-dark-800 flex items-center justify-center border border-white/10 text-slate-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-bold text-white">Tenda Eiger 2P</p>
                                                    <p class="text-xs text-slate-500">ID: T-04</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="condition_2" value="good" class="peer sr-only" checked>
                                                    <div class="px-3 py-1.5 rounded-lg border border-white/10 text-slate-400 text-xs font-bold peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:border-emerald-500 transition">Baik</div>
                                                </label>
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="condition_2" value="damaged" class="peer sr-only">
                                                    <div class="px-3 py-1.5 rounded-lg border border-white/10 text-slate-400 text-xs font-bold peer-checked:bg-yellow-500 peer-checked:text-dark-950 peer-checked:border-yellow-500 transition">Rusak</div>
                                                </label>
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="condition_2" value="lost" class="peer sr-only">
                                                    <div class="px-3 py-1.5 rounded-lg border border-white/10 text-slate-400 text-xs font-bold peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 transition">Hilang</div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 2: Notes -->
                                <div>
                                    <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-3">2. Catatan Petugas</h4>
                                    <textarea name="notes" rows="3" class="w-full bg-dark-800 border border-white/10 rounded-xl p-4 text-sm text-white focus:ring-ops-500 focus:border-ops-500 placeholder-slate-600" placeholder="Tambahkan catatan jika ada kerusakan (misal: frame tenda patah 1, rain cover sobek)..."></textarea>
                                </div>
                            </div>

                            <!-- Right: Billing Calculation -->
                            <div class="bg-dark-950 rounded-2xl p-6 border border-white/5 h-fit">
                                <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-b border-white/10 pb-4">Kalkulasi Akhir</h4>
                                
                                <div class="space-y-4 mb-6">
                                    <!-- Late Fee Display -->
                                    <div class="flex justify-between items-center bg-white/5 p-3 rounded-lg">
                                        <div>
                                            <p class="text-xs text-slate-400">Keterlambatan</p>
                                            <p class="text-sm font-bold text-white" x-text="lateDays > 0 ? lateDays + ' Hari' : 'Tepat Waktu'"></p>
                                        </div>
                                        <div class="text-right" x-show="lateDays > 0">
                                            <p class="text-xs text-slate-400">Denda</p>
                                            <p class="text-sm font-bold text-red-400" x-text="'Rp ' + (lateDays * finePerDay).toLocaleString()"></p>
                                        </div>
                                        <div class="text-right" x-show="lateDays === 0">
                                            <span class="text-emerald-500 text-xs font-bold">Rp 0</span>
                                        </div>
                                    </div>

                                    <!-- Damage Cost Input -->
                                    <div>
                                        <label class="block text-xs text-slate-400 mb-2">Biaya Kerusakan / Ganti Rugi</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-2.5 text-slate-500 text-sm font-bold">Rp</span>
                                            <input x-model="damageCost" type="number" class="w-full bg-dark-800 border border-white/10 rounded-xl py-2 pl-10 pr-4 text-white text-right focus:ring-ops-500 focus:border-ops-500 transition font-mono" placeholder="0">
                                        </div>
                                        <p class="text-[10px] text-slate-500 mt-1 italic">Input nominal jika ada barang rusak/hilang.</p>
                                    </div>
                                </div>

                                <div class="border-t border-white/10 pt-4 mb-6">
                                    <div class="flex justify-between items-end">
                                        <span class="text-sm font-bold text-slate-300">Total Tagihan</span>
                                        <span class="text-2xl font-display font-bold text-ops-500" x-text="'Rp ' + totalFine.toLocaleString()"></span>
                                    </div>
                                </div>

                                <button type="submit" class="w-full py-3.5 bg-ops-600 hover:bg-ops-500 text-white font-bold rounded-xl transition-all shadow-lg shadow-ops-500/20 flex justify-center items-center gap-2 group">
                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Selesaikan Pengembalian
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection