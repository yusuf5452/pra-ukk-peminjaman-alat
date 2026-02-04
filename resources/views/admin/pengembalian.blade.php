@extends('layouts.admin')

@section('header', 'Pengembalian & Denda')

@section('content')
    <div x-data="{ 
        showProcessModal: false,
        activeFilter: 'active',
        search: '',
        lateDays: 0,
        dendaPerDay: 50000,
        damageFee: 0,
        
        // Helper untuk hitung total denda
        get totalDenda() {
            return (this.lateDays * this.dendaPerDay) + parseInt(this.damageFee || 0);
        }
    }">

        <!-- Top Action Bar -->
        <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center gap-4 mb-8">
            
            <!-- Status Filters -->
            <div class="flex flex-wrap gap-2">
                <button @click="activeFilter = 'active'" 
                    :class="activeFilter === 'active' ? 'bg-brand-500 text-dark-950 border-brand-500' : 'bg-white/5 text-slate-400 border-white/10 hover:bg-white/10'"
                    class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider border transition-all">
                    Perlu Dikembalikan
                </button>
                <button @click="activeFilter = 'late'" 
                    :class="activeFilter === 'late' ? 'bg-red-500 text-white border-red-500' : 'bg-white/5 text-slate-400 border-white/10 hover:bg-white/10'"
                    class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider border transition-all">
                    Terlambat
                </button>
                <button @click="activeFilter = 'completed'" 
                    :class="activeFilter === 'completed' ? 'bg-slate-500 text-white border-slate-500' : 'bg-white/5 text-slate-400 border-white/10 hover:bg-white/10'"
                    class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider border transition-all">
                    Riwayat Selesai
                </button>
            </div>

            <!-- Search -->
            <div class="relative group w-full xl:w-64">
                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-slate-500 group-focus-within:text-brand-500 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input x-model="search" type="text" placeholder="Cari kode trx atau nama..." class="bg-dark-800/50 border border-white/10 text-white text-sm rounded-xl focus:ring-brand-500 focus:border-brand-500 block w-full pl-10 p-2.5 placeholder-slate-500 transition-all">
            </div>
        </div>

        <!-- RETURNS TABLE -->
        <div class="bg-dark-800/50 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-sm overflow-x-auto">
            <table class="w-full text-left min-w-[1000px]">
                <thead class="bg-white/5 text-xs uppercase text-slate-400 font-bold">
                    <tr>
                        <th class="px-6 py-4">Kode Trx</th>
                        <th class="px-6 py-4">Peminjam</th>
                        <th class="px-6 py-4">Barang</th>
                        <th class="px-6 py-4">Jatuh Tempo</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 text-sm">
                    
                    <!-- Row 1: Active (On Time) -->
                    <tr x-show="activeFilter === 'active' || activeFilter === 'all'" class="hover:bg-white/5 transition-colors group">
                        <td class="px-6 py-4 font-mono text-brand-500">#TRX-8820</td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-white">Budi Santoso</div>
                            <div class="text-xs text-slate-500">0899-8888-7777</div>
                        </td>
                        <td class="px-6 py-4 text-slate-300">Carrier Osprey 60L</td>
                        <td class="px-6 py-4">
                            <div class="text-white font-medium">Besok, 21 Okt</div>
                            <div class="text-xs text-emerald-500">Sisa 1 Hari</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-blue-500/10 text-blue-500 border border-blue-500/20">
                                Dipinjam
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button @click="showProcessModal = true; lateDays = 0" class="px-3 py-1.5 bg-brand-500 hover:bg-brand-600 text-dark-950 rounded-lg text-xs font-bold transition flex items-center gap-1 mx-auto">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                Proses Kembali
                            </button>
                        </td>
                    </tr>

                    <!-- Row 2: Late (Terlambat) -->
                    <tr x-show="activeFilter === 'active' || activeFilter === 'late' || activeFilter === 'all'" class="hover:bg-white/5 transition-colors group bg-red-500/5 border-l-4 border-l-red-500">
                        <td class="px-6 py-4 font-mono text-white">#TRX-8815</td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-white">Dimas Anggara</div>
                            <div class="text-xs text-slate-500">0812-9999-0000</div>
                        </td>
                        <td class="px-6 py-4 text-slate-300">Tenda Great Outdoor 4P</td>
                        <td class="px-6 py-4">
                            <div class="text-white font-medium">18 Okt 2024</div>
                            <div class="text-xs text-red-500 font-bold">Telat 2 Hari</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-red-500/10 text-red-500 border border-red-500/20">
                                Terlambat
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button @click="showProcessModal = true; lateDays = 2" class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-xs font-bold transition flex items-center gap-1 mx-auto shadow-lg shadow-red-500/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Proses Denda
                            </button>
                        </td>
                    </tr>

                    <!-- Row 3: Completed -->
                    <tr x-show="activeFilter === 'completed' || activeFilter === 'all'" class="hover:bg-white/5 transition-colors group opacity-60">
                        <td class="px-6 py-4 font-mono text-slate-500">#TRX-8810</td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-white">Siti Aminah</div>
                        </td>
                        <td class="px-6 py-4 text-slate-300">Sepatu Hiking (38)</td>
                        <td class="px-6 py-4 text-slate-400">
                            Dikembalikan 15 Okt
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-slate-700 text-slate-300 border border-slate-600">
                                Selesai
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button class="text-xs text-slate-400 hover:text-white underline">Lihat Detail</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <!-- ================= PROCESS RETURN MODAL ================= -->
        <div x-show="showProcessModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showProcessModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-black/80 transition-opacity" @click="showProcessModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                
                <div class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl w-full">
                    <form action="#" method="POST"> <!-- Route update status -->
                        @csrf
                        
                        <!-- Header -->
                        <div class="bg-dark-800 p-6 border-b border-white/5 flex justify-between items-center">
                            <div>
                                <h3 class="text-xl font-bold text-white">Proses Pengembalian Barang</h3>
                                <p class="text-sm text-slate-400">Transaksi <span class="font-mono text-brand-500">#TRX-8815</span> - Dimas Anggara</p>
                            </div>
                            <button type="button" @click="showProcessModal = false" class="text-slate-400 hover:text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                        </div>

                        <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
                            
                            <!-- Left: Item Checklist -->
                            <div class="lg:col-span-2 space-y-6">
                                <div>
                                    <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-3">1. Cek Kondisi Barang</h4>
                                    <div class="bg-dark-950 border border-white/5 rounded-xl overflow-hidden">
                                        <div class="p-4 border-b border-white/5 flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded bg-dark-800 flex items-center justify-center border border-white/10">
                                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-bold text-white">Tenda Great Outdoor 4P</p>
                                                    <p class="text-xs text-slate-500">Kode: ALAT-001</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <select class="bg-dark-800 border border-white/10 text-white text-xs rounded-lg px-2 py-1 focus:ring-brand-500 focus:border-brand-500">
                                                    <option value="baik">Baik (Lengkap)</option>
                                                    <option value="rusak">Rusak</option>
                                                    <option value="hilang">Hilang</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Item 2 example -->
                                        <div class="p-4 flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded bg-dark-800 flex items-center justify-center border border-white/10">
                                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-bold text-white">Pasak Tambahan (4)</p>
                                                    <p class="text-xs text-slate-500">Kode: ALAT-005</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <select class="bg-dark-800 border border-white/10 text-white text-xs rounded-lg px-2 py-1 focus:ring-brand-500 focus:border-brand-500">
                                                    <option value="baik">Baik (Lengkap)</option>
                                                    <option value="hilang">Hilang</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-3">2. Catatan Petugas</h4>
                                    <textarea name="notes" rows="3" class="w-full bg-dark-800 border border-white/10 rounded-xl p-3 text-sm text-white focus:ring-brand-500 focus:border-brand-500" placeholder="Catatan kondisi alat, bagian yang kotor, atau kerusakan spesifik..."></textarea>
                                </div>
                            </div>

                            <!-- Right: Calculation -->
                            <div class="bg-dark-950 rounded-2xl p-6 border border-white/5 h-fit">
                                <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-b border-white/10 pb-2">Rincian Biaya</h4>
                                
                                <div class="space-y-4 mb-6">
                                    <!-- Late Fee -->
                                    <div>
                                        <div class="flex justify-between text-sm mb-1">
                                            <span class="text-slate-400">Keterlambatan</span>
                                            <span class="text-white font-bold" x-text="lateDays + ' Hari'"></span>
                                        </div>
                                        <div class="flex justify-between text-sm mb-1">
                                            <span class="text-slate-400">Denda / Hari</span>
                                            <span class="text-white">Rp 50.000</span>
                                        </div>
                                        <div class="flex justify-between text-sm text-red-400 font-bold bg-red-500/10 p-2 rounded">
                                            <span>Total Denda Telat</span>
                                            <span x-text="'Rp ' + (lateDays * dendaPerDay).toLocaleString()"></span>
                                        </div>
                                    </div>

                                    <!-- Damage Fee Input -->
                                    <div>
                                        <label class="block text-xs text-slate-400 mb-1">Biaya Kerusakan / Ganti Rugi</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-2 text-slate-500 text-sm">Rp</span>
                                            <input x-model="damageFee" type="number" class="w-full bg-dark-800 border border-white/10 rounded-lg py-1.5 pl-8 pr-3 text-white text-sm text-right focus:ring-brand-500 focus:border-brand-500" placeholder="0">
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-white/10 pt-4 mb-6">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-bold text-white">Total Tagihan</span>
                                        <span class="text-2xl font-display font-bold text-brand-500" x-text="'Rp ' + totalDenda.toLocaleString()"></span>
                                    </div>
                                    <p class="text-[10px] text-slate-500 text-right mt-1">*Diluar biaya sewa awal</p>
                                </div>

                                <button type="submit" class="w-full py-3 bg-brand-500 hover:bg-brand-600 text-dark-950 font-bold rounded-xl transition-all shadow-[0_0_20px_rgba(0,220,130,0.2)] hover:shadow-[0_0_30px_rgba(0,220,130,0.4)]">
                                    Konfirmasi Pengembalian
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection