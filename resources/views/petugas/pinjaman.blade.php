@extends('layouts.petugas')

@section('header', 'Daftar Peminjaman')

@section('content')
    <div x-data="{ 
        activeFilter: 'all',
        showDetailModal: false,
        search: ''
    }">

        <!-- Status Filter Tabs -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
            <div class="bg-dark-800/50 p-1 rounded-xl flex border border-white/5 overflow-x-auto max-w-full">
                <button @click="activeFilter = 'all'" 
                    :class="activeFilter === 'all' ? 'bg-ops-500 text-white shadow-lg' : 'text-slate-400 hover:text-white'"
                    class="px-6 py-2 rounded-lg text-sm font-bold transition-all whitespace-nowrap">
                    Semua
                </button>
                <button @click="activeFilter = 'active'" 
                    :class="activeFilter === 'active' ? 'bg-ops-500 text-white shadow-lg' : 'text-slate-400 hover:text-white'"
                    class="px-6 py-2 rounded-lg text-sm font-bold transition-all whitespace-nowrap">
                    Sedang Dipinjam
                </button>
                <button @click="activeFilter = 'overdue'" 
                    :class="activeFilter === 'overdue' ? 'bg-red-500 text-white shadow-lg' : 'text-slate-400 hover:text-white'"
                    class="px-6 py-2 rounded-lg text-sm font-bold transition-all whitespace-nowrap">
                    Terlambat
                </button>
                <button @click="activeFilter = 'completed'" 
                    :class="activeFilter === 'completed' ? 'bg-slate-600 text-white shadow-lg' : 'text-slate-400 hover:text-white'"
                    class="px-6 py-2 rounded-lg text-sm font-bold transition-all whitespace-nowrap">
                    Selesai
                </button>
            </div>

            <!-- Search -->
            <div class="relative group w-full md:w-64">
                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-slate-500 group-focus-within:text-ops-500 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input x-model="search" type="text" placeholder="Cari peminjam / kode..." class="bg-dark-800/50 border border-white/10 text-white text-sm rounded-xl focus:ring-ops-500 focus:border-ops-500 block w-full pl-10 p-2.5 placeholder-slate-500 transition-all">
            </div>
        </div>

        <!-- LOANS LIST GRID -->
        <div class="grid grid-cols-1 gap-4">
            
            <!-- Item 1: Active Loan (Safe) -->
            <div x-show="activeFilter === 'all' || activeFilter === 'active'" class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 hover:border-ops-500/30 transition-all group relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-ops-500"></div>
                
                <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-6">
                    <!-- User & Status -->
                    <div class="flex items-start gap-4 min-w-[250px]">
                        <img class="w-12 h-12 rounded-full object-cover border-2 border-ops-500/50" src="https://ui-avatars.com/api/?name=Budi+Santoso&background=random" alt="User">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <h4 class="font-bold text-white text-lg">Budi Santoso</h4>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-ops-500/10 text-ops-400 border border-ops-500/20">Active</span>
                            </div>
                            <p class="text-sm text-slate-400 font-mono">#TRX-8820</p>
                        </div>
                    </div>

                    <!-- Items Summary -->
                    <div class="flex-1">
                        <p class="text-xs text-slate-500 uppercase font-bold mb-2">Item Dipinjam</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-white/5 rounded-lg text-sm text-slate-300 border border-white/10">Carrier Osprey 60L</span>
                            <span class="px-3 py-1 bg-white/5 rounded-lg text-sm text-slate-300 border border-white/10">Tenda Eiger 2P</span>
                        </div>
                    </div>

                    <!-- Duration Monitor -->
                    <div class="min-w-[200px] text-right">
                        <p class="text-xs text-slate-500 uppercase font-bold mb-1">Sisa Waktu</p>
                        <div class="text-xl font-bold text-white mb-1">1 Hari 4 Jam</div>
                        <p class="text-xs text-ops-400">Kembali: Besok, 10:00 WIB</p>
                    </div>

                    <!-- Action -->
                    <div>
                        <button @click="showDetailModal = true" class="p-3 bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white rounded-xl transition border border-white/10">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Item 2: Overdue Loan (Warning) -->
            <div x-show="activeFilter === 'all' || activeFilter === 'overdue'" class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 hover:border-red-500/30 transition-all group relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-red-500"></div>
                
                <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-6">
                    <!-- User & Status -->
                    <div class="flex items-start gap-4 min-w-[250px]">
                        <img class="w-12 h-12 rounded-full object-cover border-2 border-red-500/50" src="https://ui-avatars.com/api/?name=Dimas+Anggara&background=random" alt="User">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <h4 class="font-bold text-white text-lg">Dimas Anggara</h4>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-red-500/10 text-red-400 border border-red-500/20">Terlambat</span>
                            </div>
                            <p class="text-sm text-slate-400 font-mono">#TRX-8815</p>
                        </div>
                    </div>

                    <!-- Items Summary -->
                    <div class="flex-1">
                        <p class="text-xs text-slate-500 uppercase font-bold mb-2">Item Dipinjam</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-white/5 rounded-lg text-sm text-slate-300 border border-white/10">Sepatu Hiking (42)</span>
                        </div>
                    </div>

                    <!-- Duration Monitor -->
                    <div class="min-w-[200px] text-right">
                        <p class="text-xs text-slate-500 uppercase font-bold mb-1">Status Waktu</p>
                        <div class="text-xl font-bold text-red-500 mb-1">- 2 Hari</div>
                        <p class="text-xs text-slate-400">Harusnya: 18 Okt 2024</p>
                    </div>

                    <!-- Action -->
                    <div class="flex gap-2">
                        <a href="{{ route('petugas.pengembalian.index') }}" class="px-4 py-2 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-xl text-xs font-bold transition border border-red-500/20 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Denda
                        </a>
                        <button @click="showDetailModal = true" class="p-3 bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white rounded-xl transition border border-white/10">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Item 3: Completed (History) -->
            <div x-show="activeFilter === 'all' || activeFilter === 'completed'" class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 opacity-60 hover:opacity-100 transition-all group relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-slate-600"></div>
                
                <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-6">
                    <div class="flex items-start gap-4 min-w-[250px]">
                        <img class="w-12 h-12 rounded-full object-cover grayscale" src="https://ui-avatars.com/api/?name=Siti+Aminah&background=random" alt="User">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <h4 class="font-bold text-white text-lg">Siti Aminah</h4>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-slate-700 text-slate-300 border border-slate-600">Selesai</span>
                            </div>
                            <p class="text-sm text-slate-400 font-mono">#TRX-8810</p>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-slate-500 uppercase font-bold mb-2">Item Dipinjam</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-white/5 rounded-lg text-sm text-slate-300 border border-white/10">Kompor Portable</span>
                        </div>
                    </div>
                    <div class="min-w-[200px] text-right">
                        <p class="text-xs text-slate-500 uppercase font-bold mb-1">Dikembalikan</p>
                        <div class="text-xl font-bold text-slate-300 mb-1">15 Okt 2024</div>
                        <p class="text-xs text-emerald-500">Tepat Waktu</p>
                    </div>
                    <div>
                        <button @click="showDetailModal = true" class="p-3 bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white rounded-xl transition border border-white/10">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- ================= DETAIL MODAL ================= -->
        <div x-show="showDetailModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showDetailModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-black/80 transition-opacity" @click="showDetailModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                
                <div class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">
                    
                    <!-- Header -->
                    <div class="bg-dark-800 p-6 border-b border-white/5 flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-bold text-white">Detail Transaksi <span class="text-ops-500 font-mono">#TRX-8820</span></h3>
                            <p class="text-xs text-slate-400 mt-1">Dipinjam pada: 18 Okt 2024, 09:00 WIB</p>
                        </div>
                        <button @click="showDetailModal = false" class="text-slate-400 hover:text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                    </div>

                    <div class="p-6 space-y-6">
                        
                        <!-- Borrower Info -->
                        <div class="bg-dark-950 p-4 rounded-xl border border-white/5 flex items-center gap-4">
                            <img class="w-12 h-12 rounded-full object-cover" src="https://ui-avatars.com/api/?name=Budi+Santoso&background=random" alt="User">
                            <div class="flex-1">
                                <h4 class="font-bold text-white">Budi Santoso</h4>
                                <div class="flex gap-4 text-xs text-slate-400 mt-1">
                                    <span class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg> 0899-8888-7777</span>
                                    <span class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg> budi@email.com</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="block text-xs text-slate-500 uppercase font-bold">Total Tagihan</span>
                                <span class="text-lg font-bold text-white">Rp 135.000</span>
                            </div>
                        </div>

                        <!-- Items List -->
                        <div>
                            <h4 class="text-sm font-bold text-white mb-3">Barang yang Dipinjam</h4>
                            <div class="bg-dark-950 border border-white/5 rounded-xl overflow-hidden">
                                <table class="w-full text-left text-sm">
                                    <thead class="bg-white/5 text-slate-400 text-xs uppercase font-bold">
                                        <tr>
                                            <th class="px-4 py-3">Nama Alat</th>
                                            <th class="px-4 py-3 text-center">Jumlah</th>
                                            <th class="px-4 py-3">Kondisi Awal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-white/5 text-slate-300">
                                        <tr>
                                            <td class="px-4 py-3">Carrier Osprey 60L</td>
                                            <td class="px-4 py-3 text-center">1</td>
                                            <td class="px-4 py-3"><span class="text-emerald-500 text-xs font-bold">Baik</span></td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3">Tenda Eiger 2P</td>
                                            <td class="px-4 py-3 text-center">1</td>
                                            <td class="px-4 py-3"><span class="text-emerald-500 text-xs font-bold">Baik</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Timeline -->
                        <div class="bg-white/5 p-4 rounded-xl border border-white/5">
                            <h4 class="text-xs font-bold text-slate-400 uppercase mb-3">Durasi Peminjaman</h4>
                            <div class="flex items-center justify-between text-sm">
                                <div>
                                    <p class="text-slate-500">Mulai</p>
                                    <p class="text-white font-bold">18 Okt 2024</p>
                                </div>
                                <div class="flex-1 px-4 text-center">
                                    <div class="w-full bg-dark-950 h-2 rounded-full overflow-hidden">
                                        <div class="bg-ops-500 h-full w-3/4 rounded-full"></div>
                                    </div>
                                    <p class="text-xs text-ops-400 mt-1 font-bold">Sisa 1 Hari</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-slate-500">Selesai</p>
                                    <p class="text-white font-bold">21 Okt 2024</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <div class="p-6 border-t border-white/5 bg-dark-800 rounded-b-2xl flex justify-end">
                        <button class="px-4 py-2 bg-ops-600 hover:bg-ops-500 text-white font-bold rounded-lg text-sm transition">
                            Cetak Bukti Peminjaman
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection