@extends('layouts.peminjam')

@section('header', 'Riwayat Peminjaman')

@section('content')
    <div x-data="{ 
        activeTab: 'all',
        search: '',
        showDetailModal: false,
        selectedTransaction: null,
        
        // Data Dummy
        viewDetail(trx) {
            this.selectedTransaction = trx;
            this.showDetailModal = true;
        }
    }">

        <!-- Filters & Search -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
            <div class="bg-dark-800/50 p-1 rounded-xl flex border border-white/5 overflow-x-auto max-w-full">
                <button @click="activeTab = 'all'" 
                    :class="activeTab === 'all' ? 'bg-adv-500 text-white shadow-lg' : 'text-slate-400 hover:text-white'"
                    class="px-5 py-2 rounded-lg text-sm font-bold transition-all whitespace-nowrap">
                    Semua
                </button>
                <button @click="activeTab = 'active'" 
                    :class="activeTab === 'active' ? 'bg-blue-500 text-white shadow-lg' : 'text-slate-400 hover:text-white'"
                    class="px-5 py-2 rounded-lg text-sm font-bold transition-all whitespace-nowrap">
                    Berlangsung
                </button>
                <button @click="activeTab = 'pending'" 
                    :class="activeTab === 'pending' ? 'bg-yellow-500 text-dark-950 shadow-lg' : 'text-slate-400 hover:text-white'"
                    class="px-5 py-2 rounded-lg text-sm font-bold transition-all whitespace-nowrap">
                    Menunggu
                </button>
                <button @click="activeTab = 'completed'" 
                    :class="activeTab === 'completed' ? 'bg-emerald-500 text-white shadow-lg' : 'text-slate-400 hover:text-white'"
                    class="px-5 py-2 rounded-lg text-sm font-bold transition-all whitespace-nowrap">
                    Selesai
                </button>
            </div>

            <div class="relative group w-full md:w-64">
                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-slate-500 group-focus-within:text-adv-500 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input x-model="search" type="text" placeholder="Cari ID transaksi..." class="bg-dark-800/50 border border-white/10 text-white text-sm rounded-xl focus:ring-adv-500 focus:border-adv-500 block w-full pl-10 p-2.5 placeholder-slate-500 transition-all">
            </div>
        </div>

        <!-- HISTORY LIST -->
        <div class="space-y-4">

            <!-- Item 1: Active Loan -->
            <div x-show="activeTab === 'all' || activeTab === 'active'" class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 hover:border-adv-500/30 transition-all group relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500"></div>
                <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-6">
                    <!-- Basic Info -->
                    <div class="min-w-[200px]">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-bold bg-blue-500/10 text-blue-500 px-2 py-0.5 rounded border border-blue-500/20 uppercase">Dipinjam</span>
                            <span class="text-xs text-slate-500 font-mono">#TRX-8822</span>
                        </div>
                        <h4 class="font-bold text-white text-lg">Tenda Eiger 4P, Matras</h4>
                        <p class="text-xs text-slate-400">Total: Rp 140.000</p>
                    </div>

                    <!-- Date & Duration -->
                    <div class="flex-1">
                        <div class="flex items-center gap-4 text-sm text-slate-300">
                            <div>
                                <p class="text-[10px] text-slate-500 uppercase font-bold">Ambil</p>
                                <p class="font-medium">20 Okt 2024</p>
                            </div>
                            <div class="h-px w-8 bg-slate-600"></div>
                            <div>
                                <p class="text-[10px] text-slate-500 uppercase font-bold">Kembali</p>
                                <p class="font-medium">22 Okt 2024</p>
                            </div>
                            <div class="ml-4 px-3 py-1 bg-dark-950 rounded-lg text-xs font-bold text-adv-500">
                                Sisa 1 Hari
                            </div>
                        </div>
                    </div>

                    <!-- Action -->
                    <div>
                        <button @click="viewDetail({id: '#TRX-8822', status: 'active', items: 'Tenda Eiger 4P, Matras', total: 140000, date: '20 Okt - 22 Okt'})" class="px-5 py-2 bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white rounded-xl text-sm font-bold transition border border-white/10 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Detail
                        </button>
                    </div>
                </div>
            </div>

            <!-- Item 2: Pending Approval -->
            <div x-show="activeTab === 'all' || activeTab === 'pending'" class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 hover:border-adv-500/30 transition-all group relative overflow-hidden opacity-90">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-yellow-500"></div>
                <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-6">
                    <div class="min-w-[200px]">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-bold bg-yellow-500/10 text-yellow-500 px-2 py-0.5 rounded border border-yellow-500/20 uppercase">Menunggu</span>
                            <span class="text-xs text-slate-500 font-mono">#TRX-8823</span>
                        </div>
                        <h4 class="font-bold text-white text-lg">Carrier Osprey 60L</h4>
                        <p class="text-xs text-slate-400">Total: Rp 90.000</p>
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center gap-4 text-sm text-slate-300">
                            <div>
                                <p class="text-[10px] text-slate-500 uppercase font-bold">Rencana Ambil</p>
                                <p class="font-medium">25 Okt 2024</p>
                            </div>
                            <div class="h-px w-8 bg-slate-600"></div>
                            <div>
                                <p class="text-[10px] text-slate-500 uppercase font-bold">Kembali</p>
                                <p class="font-medium">27 Okt 2024</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button class="px-5 py-2 text-slate-500 cursor-not-allowed rounded-xl text-sm font-bold bg-dark-900 border border-white/5">
                            Menunggu Konfirmasi
                        </button>
                    </div>
                </div>
            </div>

            <!-- Item 3: Completed -->
            <div x-show="activeTab === 'all' || activeTab === 'completed'" class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 hover:border-adv-500/30 transition-all group relative overflow-hidden opacity-60 hover:opacity-100">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-500"></div>
                <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-6">
                    <div class="min-w-[200px]">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-bold bg-emerald-500/10 text-emerald-500 px-2 py-0.5 rounded border border-emerald-500/20 uppercase">Selesai</span>
                            <span class="text-xs text-slate-500 font-mono">#TRX-8810</span>
                        </div>
                        <h4 class="font-bold text-white text-lg">Sepatu Hiking (42)</h4>
                        <p class="text-xs text-slate-400">Total: Rp 45.000</p>
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center gap-4 text-sm text-slate-300">
                            <div>
                                <p class="text-[10px] text-slate-500 uppercase font-bold">Dikembalikan</p>
                                <p class="font-medium">15 Okt 2024</p>
                            </div>
                            <div class="ml-4 flex items-center gap-1 text-emerald-500 text-xs font-bold">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Tepat Waktu
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button class="p-2 bg-white/5 hover:bg-emerald-500 text-slate-300 hover:text-white rounded-lg transition" title="Download Invoice">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        </button>
                        <button @click="viewDetail({id: '#TRX-8810', status: 'completed', items: 'Sepatu Hiking (42)', total: 45000, date: '14 Okt - 15 Okt'})" class="px-5 py-2 bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white rounded-xl text-sm font-bold transition border border-white/10">
                            Detail
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- ================= DETAIL MODAL ================= -->
        <div x-show="showDetailModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showDetailModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-black/80 transition-opacity backdrop-blur-sm" @click="showDetailModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                
                <div class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl w-full">
                    
                    <!-- Header -->
                    <div class="bg-dark-800 p-6 border-b border-white/5 flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-bold text-white">Detail Transaksi</h3>
                            <p class="text-sm text-adv-500 font-mono" x-text="selectedTransaction?.id"></p>
                        </div>
                        <button @click="showDetailModal = false" class="text-slate-400 hover:text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                    </div>

                    <div class="p-6 space-y-6">
                        
                        <!-- Status Banner -->
                        <div class="p-4 rounded-xl border border-white/10 flex items-center justify-between" 
                             :class="selectedTransaction?.status === 'active' ? 'bg-blue-500/10 border-blue-500/20' : (selectedTransaction?.status === 'completed' ? 'bg-emerald-500/10 border-emerald-500/20' : 'bg-dark-950')">
                            <div>
                                <p class="text-xs uppercase font-bold text-slate-400">Status</p>
                                <p class="text-white font-bold text-sm" x-text="selectedTransaction?.status === 'active' ? 'Sedang Dipinjam' : 'Selesai'"></p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs uppercase font-bold text-slate-400">Tanggal</p>
                                <p class="text-white font-bold text-sm" x-text="selectedTransaction?.date"></p>
                            </div>
                        </div>

                        <!-- Items List -->
                        <div>
                            <h4 class="text-xs font-bold text-slate-500 uppercase mb-3">Rincian Item</h4>
                            <div class="bg-dark-950 border border-white/5 rounded-xl p-4 space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-300" x-text="selectedTransaction?.items"></span>
                                    <span class="text-white font-bold" x-text="'Rp ' + (selectedTransaction?.total || 0).toLocaleString()"></span>
                                </div>
                                <!-- Example Fee -->
                                <div class="flex justify-between text-sm pt-3 border-t border-white/5">
                                    <span class="text-slate-400">Biaya Admin</span>
                                    <span class="text-slate-400">Rp 0</span>
                                </div>
                                <div class="flex justify-between text-sm pt-1">
                                    <span class="text-slate-400">Denda</span>
                                    <span class="text-red-400 font-bold">Rp 0</span>
                                </div>
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="flex justify-between items-end border-t border-white/10 pt-4">
                            <span class="text-sm font-bold text-white">Total Pembayaran</span>
                            <span class="text-2xl font-display font-bold text-adv-500" x-text="'Rp ' + (selectedTransaction?.total || 0).toLocaleString()"></span>
                        </div>

                    </div>
                    
                    <div class="p-6 bg-dark-800 border-t border-white/5 flex gap-3">
                        <button class="flex-1 py-3 bg-white/5 hover:bg-white/10 text-white rounded-xl font-bold text-sm transition flex justify-center items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download Invoice
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection