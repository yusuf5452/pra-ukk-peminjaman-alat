@extends('layouts.peminjam')

@section('header', 'Jelajah Alat Outdoor')

@section('content')
    <div x-data="{ 
        activeCategory: 'all',
        showDetailModal: false,
        search: '',
        selectedItem: null,
        
        // Data Dummy untuk detail modal
        openDetail(item) {
            this.selectedItem = item;
            this.showDetailModal = true;
        }
    }">

        <!-- Header & Search -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
            <div>
                <h3 class="text-2xl font-bold text-white mb-2">Katalog Alat</h3>
                <p class="text-slate-400 max-w-lg">Temukan perlengkapan terbaik untuk petualanganmu selanjutnya.</p>
            </div>
            
            <div class="relative group w-full md:w-72">
                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-slate-500 group-focus-within:text-adv-500 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input x-model="search" type="text" placeholder="Cari nama alat..." class="bg-dark-800/50 border border-white/10 text-white text-sm rounded-xl focus:ring-adv-500 focus:border-adv-500 block w-full pl-10 p-3 placeholder-slate-500 transition-all shadow-lg">
            </div>
        </div>

        <!-- Category Filters -->
        <div class="mb-8 overflow-x-auto pb-2">
            <div class="flex gap-3">
                <button @click="activeCategory = 'all'" 
                    :class="activeCategory === 'all' ? 'bg-adv-500 text-white shadow-lg shadow-adv-500/20' : 'bg-dark-800/50 text-slate-400 hover:text-white border border-white/5'"
                    class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all whitespace-nowrap flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Semua
                </button>
                <button @click="activeCategory = 'tenda'" 
                    :class="activeCategory === 'tenda' ? 'bg-adv-500 text-white shadow-lg shadow-adv-500/20' : 'bg-dark-800/50 text-slate-400 hover:text-white border border-white/5'"
                    class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all whitespace-nowrap">
                    ⛺ Tenda
                </button>
                <button @click="activeCategory = 'carrier'" 
                    :class="activeCategory === 'carrier' ? 'bg-adv-500 text-white shadow-lg shadow-adv-500/20' : 'bg-dark-800/50 text-slate-400 hover:text-white border border-white/5'"
                    class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all whitespace-nowrap">
                    🎒 Tas Carrier
                </button>
                <button @click="activeCategory = 'sepatu'" 
                    :class="activeCategory === 'sepatu' ? 'bg-adv-500 text-white shadow-lg shadow-adv-500/20' : 'bg-dark-800/50 text-slate-400 hover:text-white border border-white/5'"
                    class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all whitespace-nowrap">
                    🥾 Sepatu
                </button>
                <button @click="activeCategory = 'masak'" 
                    :class="activeCategory === 'masak' ? 'bg-adv-500 text-white shadow-lg shadow-adv-500/20' : 'bg-dark-800/50 text-slate-400 hover:text-white border border-white/5'"
                    class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all whitespace-nowrap">
                    🔥 Alat Masak
                </button>
            </div>
        </div>

        <!-- PRODUCT GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            
            <!-- Item 1 -->
            <div x-show="activeCategory === 'all' || activeCategory === 'tenda'" class="group bg-dark-800/50 border border-white/5 rounded-2xl overflow-hidden hover:border-adv-500/30 transition-all duration-300 hover:shadow-xl hover:shadow-adv-500/5">
                <!-- Image -->
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Tenda">
                    <div class="absolute top-3 right-3 bg-dark-950/80 backdrop-blur-sm px-3 py-1 rounded-lg border border-white/10">
                        <span class="text-xs font-bold text-white">Rp 50.000</span>
                        <span class="text-[10px] text-slate-400">/hari</span>
                    </div>
                    <div class="absolute bottom-3 left-3">
                        <span class="bg-emerald-500 text-white text-[10px] font-bold px-2 py-1 rounded-full shadow-lg">Stok: 5</span>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="p-5">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="text-xs text-slate-500 uppercase font-bold tracking-wider mb-1">Tenda</p>
                            <h4 class="text-lg font-bold text-white group-hover:text-adv-500 transition-colors">Tenda Eiger 4P</h4>
                        </div>
                    </div>
                    <p class="text-sm text-slate-400 line-clamp-2 mb-4">Kapasitas 4 orang, double layer, tahan hujan deras. Cocok untuk camping keluarga.</p>
                    
                    <button @click="openDetail({name: 'Tenda Eiger 4P', category: 'Tenda', price: 50000, stock: 5, image: 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=2070&auto=format&fit=crop'})" class="w-full py-2.5 bg-white/5 hover:bg-adv-500 hover:text-white text-slate-300 rounded-xl font-bold text-sm transition-all border border-white/10 hover:border-adv-500 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        Lihat Detail
                    </button>
                </div>
            </div>

            <!-- Item 2 -->
            <div x-show="activeCategory === 'all' || activeCategory === 'carrier'" class="group bg-dark-800/50 border border-white/5 rounded-2xl overflow-hidden hover:border-adv-500/30 transition-all duration-300 hover:shadow-xl hover:shadow-adv-500/5">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Carrier">
                    <div class="absolute top-3 right-3 bg-dark-950/80 backdrop-blur-sm px-3 py-1 rounded-lg border border-white/10">
                        <span class="text-xs font-bold text-white">Rp 45.000</span>
                        <span class="text-[10px] text-slate-400">/hari</span>
                    </div>
                    <div class="absolute bottom-3 left-3">
                        <span class="bg-yellow-500 text-dark-950 text-[10px] font-bold px-2 py-1 rounded-full shadow-lg">Stok: 2</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="mb-2">
                        <p class="text-xs text-slate-500 uppercase font-bold tracking-wider mb-1">Tas Carrier</p>
                        <h4 class="text-lg font-bold text-white group-hover:text-adv-500 transition-colors">Carrier Osprey 60L</h4>
                    </div>
                    <p class="text-sm text-slate-400 line-clamp-2 mb-4">Tas gunung 60 Liter dengan backsystem jaring yang nyaman dan anti gerah.</p>
                    <button @click="openDetail({name: 'Carrier Osprey 60L', category: 'Tas Carrier', price: 45000, stock: 2, image: 'https://images.unsplash.com/photo-1551632811-561732d1e306?q=80&w=2070&auto=format&fit=crop'})" class="w-full py-2.5 bg-white/5 hover:bg-adv-500 hover:text-white text-slate-300 rounded-xl font-bold text-sm transition-all border border-white/10 hover:border-adv-500 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        Lihat Detail
                    </button>
                </div>
            </div>

            <!-- Item 3 (Stok Habis) -->
            <div x-show="activeCategory === 'all' || activeCategory === 'sepatu'" class="group bg-dark-800/50 border border-white/5 rounded-2xl overflow-hidden hover:border-red-500/30 transition-all duration-300 opacity-75 hover:opacity-100">
                <div class="relative h-48 overflow-hidden grayscale group-hover:grayscale-0 transition-all duration-500">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Sepatu">
                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                        <span class="bg-red-500 text-white font-bold px-4 py-1.5 rounded-full border-2 border-dark-950 transform -rotate-12 shadow-xl">STOK HABIS</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="mb-2">
                        <p class="text-xs text-slate-500 uppercase font-bold tracking-wider mb-1">Sepatu</p>
                        <h4 class="text-lg font-bold text-white">Sepatu Hiking (42)</h4>
                    </div>
                    <p class="text-sm text-slate-400 line-clamp-2 mb-4">Sepatu waterproof ukuran 42, sol vibram anti slip.</p>
                    <button disabled class="w-full py-2.5 bg-white/5 text-slate-500 rounded-xl font-bold text-sm cursor-not-allowed border border-white/5 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Tidak Tersedia
                    </button>
                </div>
            </div>

        </div>

        <!-- ================= DETAIL POP-UP MODAL ================= -->
        <div x-show="showDetailModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showDetailModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-black/80 transition-opacity backdrop-blur-sm" @click="showDetailModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                
                <div class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl w-full relative">
                    
                    <!-- Close Button -->
                    <button @click="showDetailModal = false" class="absolute top-4 right-4 z-10 p-2 bg-black/50 hover:bg-white text-white hover:text-black rounded-full transition-colors backdrop-blur-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>

                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <!-- Image Side -->
                        <div class="h-64 md:h-full bg-dark-800 relative">
                            <img :src="selectedItem?.image" class="w-full h-full object-cover" alt="Detail">
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-dark-900 to-transparent h-24"></div>
                        </div>

                        <!-- Content Side -->
                        <div class="p-8 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="px-3 py-1 bg-white/5 rounded-full text-xs font-bold text-slate-400 uppercase tracking-widest border border-white/10" x-text="selectedItem?.category"></span>
                                    <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 rounded-full text-xs font-bold border border-emerald-500/20" x-text="'Stok: ' + selectedItem?.stock"></span>
                                </div>
                                <h2 class="text-3xl font-display font-bold text-white mb-4" x-text="selectedItem?.name"></h2>
                                
                                <div class="flex items-end gap-2 mb-6">
                                    <span class="text-3xl font-bold text-adv-500" x-text="'Rp ' + (selectedItem?.price || 0).toLocaleString()"></span>
                                    <span class="text-sm text-slate-400 mb-1">/ 24 Jam</span>
                                </div>

                                <div class="space-y-4 mb-8">
                                    <div class="bg-dark-800 p-4 rounded-xl border border-white/5">
                                        <h4 class="text-sm font-bold text-white mb-2">Deskripsi Alat</h4>
                                        <p class="text-sm text-slate-400 leading-relaxed">
                                            Alat ini sangat cocok untuk kegiatan outdoor Anda. Terbuat dari bahan berkualitas tinggi, tahan lama, dan telah melalui proses pengecekan standar keamanan. Pastikan untuk mengecek kondisi fisik saat pengambilan.
                                        </p>
                                    </div>
                                    
                                    <div class="flex gap-4 text-sm text-slate-400">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            Kondisi Prima
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            Siap Pakai
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex gap-3 pt-6 border-t border-white/10">
                                <button class="flex-1 py-3.5 bg-dark-800 hover:bg-dark-700 text-white rounded-xl font-bold transition border border-white/10 flex justify-center items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                    Wishlist
                                </button>
                                <a href="{{ route('peminjam.pengajuan.index') }}" class="flex-[2] py-3.5 bg-adv-500 hover:bg-adv-600 text-white rounded-xl font-bold transition shadow-lg shadow-adv-500/20 text-center flex justify-center items-center gap-2">
                                    Ajukan Pinjam Sekarang
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection