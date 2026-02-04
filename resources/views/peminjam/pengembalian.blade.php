@extends('layouts.peminjam')

@section('header', 'Pengembalian Alat')

@section('content')
    <div x-data="{ 
        showExtendModal: false,
        showReturnModal: false,
        selectedLoan: null,
        extensionDays: 1,
        
        // Data Dummy
        loans: [
            {
                id: '#TRX-8822',
                items: [
                    { name: 'Tenda Eiger 4P', image: 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=2070&auto=format&fit=crop' },
                    { name: 'Matras Foil', image: 'https://images.unsplash.com/photo-1623944889288-cd147dbb517c?q=80&w=2070&auto=format&fit=crop' }
                ],
                dueDate: '22 Okt 2024', // Besok
                status: 'active', // active, overdue
                daysLeft: 1
            },
            {
                id: '#TRX-8820',
                items: [
                    { name: 'Headlamp Petzl', image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=2070&auto=format&fit=crop' } // Placeholder img
                ],
                dueDate: '20 Okt 2024', // Kemarin
                status: 'overdue',
                daysLeft: -1
            }
        ],

        openExtend(loan) {
            this.selectedLoan = loan;
            this.extensionDays = 1;
            this.showExtendModal = true;
        },

        openReturn(loan) {
            this.selectedLoan = loan;
            this.showReturnModal = true;
        }
    }">

        <!-- Header Info -->
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-white mb-2">Barang dalam Peminjaman</h3>
            <p class="text-slate-400">Pastikan mengembalikan alat tepat waktu untuk menghindari denda.</p>
        </div>

        <!-- LOAN CARDS -->
        <div class="space-y-6">
            
            <template x-for="loan in loans" :key="loan.id">
                <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 relative overflow-hidden transition-all hover:border-white/10 group">
                    
                    <!-- Status Indicator Bar -->
                    <div class="absolute left-0 top-0 bottom-0 w-1" 
                         :class="loan.status === 'overdue' ? 'bg-red-500' : 'bg-adv-500'"></div>

                    <div class="flex flex-col lg:flex-row gap-6">
                        
                        <!-- Left: Transaction Info & Date -->
                        <div class="min-w-[200px] flex flex-col justify-between">
                            <div>
                                <span class="text-xs font-mono text-slate-500" x-text="loan.id"></span>
                                <h4 class="text-lg font-bold text-white mt-1" x-text="loan.status === 'overdue' ? 'Terlambat!' : 'Sedang Dipinjam'"></h4>
                                
                                <div class="mt-3 flex items-center gap-2">
                                    <div class="px-3 py-1 rounded-lg text-xs font-bold border"
                                         :class="loan.status === 'overdue' ? 'bg-red-500/10 text-red-500 border-red-500/20' : 'bg-adv-500/10 text-adv-500 border-adv-500/20'">
                                        <span x-text="loan.status === 'overdue' ? 'Telat ' + Math.abs(loan.daysLeft) + ' Hari' : 'Sisa ' + loan.daysLeft + ' Hari'"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4 lg:mt-0">
                                <p class="text-[10px] uppercase font-bold text-slate-500">Jatuh Tempo</p>
                                <p class="text-white font-medium flex items-center gap-2">
                                    <svg class="w-4 h-4" :class="loan.status === 'overdue' ? 'text-red-500' : 'text-slate-300'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span x-text="loan.dueDate"></span>
                                </p>
                            </div>
                        </div>

                        <!-- Middle: Items List -->
                        <div class="flex-1 border-t lg:border-t-0 lg:border-l border-white/5 lg:pl-6 pt-4 lg:pt-0">
                            <p class="text-xs text-slate-500 uppercase font-bold mb-3">Item yang dibawa:</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <template x-for="item in loan.items">
                                    <div class="flex items-center gap-3 bg-dark-900/50 p-2 rounded-xl border border-white/5">
                                        <img :src="item.image" class="w-10 h-10 rounded-lg object-cover bg-dark-800">
                                        <span class="text-sm text-slate-300 font-medium" x-text="item.name"></span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Right: Actions -->
                        <div class="flex flex-row lg:flex-col gap-3 justify-center min-w-[180px]">
                            <button @click="openReturn(loan)" class="flex-1 lg:flex-none py-3 px-4 bg-white hover:bg-slate-200 text-dark-950 rounded-xl font-bold text-sm transition shadow-lg flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z"/></svg>
                                Kembalikan
                            </button>
                            <button @click="openExtend(loan)" class="flex-1 lg:flex-none py-3 px-4 bg-dark-900 hover:bg-dark-950 text-slate-300 hover:text-white rounded-xl font-bold text-sm transition border border-white/10 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Perpanjang
                            </button>
                        </div>

                    </div>
                </div>
            </template>

        </div>

        <!-- ================= EXTENSION MODAL ================= -->
        <div x-show="showExtendModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showExtendModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-black/80 transition-opacity backdrop-blur-sm" @click="showExtendModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                
                <div class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full">
                    <form action="#" method="POST" class="p-6">
                        @csrf
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-white">Ajukan Perpanjangan</h3>
                            <button type="button" @click="showExtendModal = false" class="text-slate-400 hover:text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                        </div>

                        <div class="bg-blue-500/10 border border-blue-500/20 p-4 rounded-xl mb-6">
                            <p class="text-xs text-blue-400">Perpanjangan dikenakan biaya sewa normal. Pastikan mengajukan sebelum jatuh tempo untuk menghindari denda.</p>
                        </div>

                        <div class="space-y-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-400 mb-2">Tambah Durasi (Hari)</label>
                                <div class="flex items-center gap-4">
                                    <button type="button" @click="extensionDays = Math.max(1, extensionDays - 1)" class="w-10 h-10 rounded-xl bg-dark-800 border border-white/10 text-white hover:bg-white/10 flex items-center justify-center transition">-</button>
                                    <input type="number" x-model="extensionDays" class="w-20 text-center bg-dark-900 border border-white/10 rounded-xl py-2 text-white font-bold" readonly>
                                    <button type="button" @click="extensionDays++" class="w-10 h-10 rounded-xl bg-dark-800 border border-white/10 text-white hover:bg-white/10 flex items-center justify-center transition">+</button>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-slate-400 mb-2">Estimasi Biaya Tambahan</label>
                                <div class="text-xl font-bold text-adv-500" x-text="'Rp ' + (extensionDays * 50000).toLocaleString()"></div>
                                <p class="text-xs text-slate-500 mt-1">*Berdasarkan tarif harian alat</p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <button type="button" @click="showExtendModal = false" class="flex-1 py-2.5 bg-white/5 hover:bg-white/10 text-slate-300 rounded-xl font-bold text-sm transition">Batal</button>
                            <button type="submit" class="flex-1 py-2.5 bg-adv-500 hover:bg-adv-600 text-white rounded-xl font-bold text-sm transition shadow-lg shadow-adv-500/20">Kirim Pengajuan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ================= RETURN CONFIRMATION MODAL ================= -->
        <div x-show="showReturnModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showReturnModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-black/80 transition-opacity backdrop-blur-sm" @click="showReturnModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                
                <div class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm w-full">
                    <div class="p-6 text-center">
                        <div class="w-16 h-16 bg-white rounded-xl mx-auto mb-4 flex items-center justify-center p-1">
                            <!-- Placeholder QR Code -->
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=RETURN-TRX-8822" class="w-full h-full">
                        </div>
                        
                        <h3 class="text-xl font-bold text-white mb-2">Kode Pengembalian</h3>
                        <p class="text-xl font-mono text-adv-500 font-bold tracking-widest mb-4" x-text="selectedLoan?.id"></p>
                        
                        <div class="bg-dark-950 p-4 rounded-xl border border-white/5 text-sm text-slate-400 mb-6">
                            <p>Tunjukkan kode QR ini kepada petugas saat mengembalikan alat di konter.</p>
                        </div>

                        <button @click="showReturnModal = false" class="w-full py-3 bg-white hover:bg-slate-200 text-dark-950 rounded-xl font-bold text-sm transition">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection