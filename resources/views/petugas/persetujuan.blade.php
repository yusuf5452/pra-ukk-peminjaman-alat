@extends('layouts.petugas')

@section('header', 'Verifikasi Peminjaman')

@section('content')
    <div x-data="{ 
        showDetailModal: false,
        showRejectModal: false,
        search: '',
        selectedItem: null,
        
        // Data simulasi untuk modal detail (nanti diganti data dinamis)
        openDetail(id) {
            this.selectedItem = id;
            this.showDetailModal = true;
        }
    }">

        <!-- Top Stats & Search -->
        <div class="flex flex-col md:flex-row justify-between items-end gap-4 mb-8">
            <div class="flex gap-3">
                <div class="bg-yellow-500/10 border border-yellow-500/20 px-5 py-3 rounded-2xl flex items-center gap-3">
                    <div class="p-2 bg-yellow-500 rounded-lg text-dark-950">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Menunggu Respon</p>
                        <p class="text-xl font-bold text-white">5 <span class="text-xs font-normal text-yellow-500">Pengajuan</span></p>
                    </div>
                </div>
                <div class="bg-ops-500/10 border border-ops-500/20 px-5 py-3 rounded-2xl flex items-center gap-3">
                    <div class="p-2 bg-ops-500 rounded-lg text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Disetujui Hari Ini</p>
                        <p class="text-xl font-bold text-white">12 <span class="text-xs font-normal text-ops-500">Transaksi</span></p>
                    </div>
                </div>
            </div>

            <div class="relative group w-full md:w-64">
                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-slate-500 group-focus-within:text-ops-500 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input x-model="search" type="text" placeholder="Cari peminjam..." class="bg-dark-800/50 border border-white/10 text-white text-sm rounded-xl focus:ring-ops-500 focus:border-ops-500 block w-full pl-10 p-2.5 placeholder-slate-500 transition-all">
            </div>
        </div>

        <!-- PENDING REQUESTS TABLE -->
        <div class="bg-dark-800/50 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-sm">
            <div class="p-6 border-b border-white/5 flex justify-between items-center">
                <h3 class="font-bold text-white text-lg flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span>
                    Daftar Pengajuan Pending
                </h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-white/5 text-xs uppercase text-slate-400 font-bold">
                        <tr>
                            <th class="px-6 py-4">Peminjam</th>
                            <th class="px-6 py-4">Rencana Pinjam</th>
                            <th class="px-6 py-4">Barang Utama</th>
                            <th class="px-6 py-4">Estimasi Biaya</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-sm">
                        
                        <!-- Item 1 -->
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img class="h-9 w-9 rounded-full object-cover border border-ops-500/30" src="https://ui-avatars.com/api/?name=Rina+Wati&background=random" alt="Avatar">
                                    <div>
                                        <div class="font-bold text-white">Rina Wati</div>
                                        <div class="text-xs text-slate-500">Member Basic</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-300">
                                <div>22 Okt - 24 Okt</div>
                                <div class="text-xs text-ops-400 font-bold">2 Hari</div>
                            </td>
                            <td class="px-6 py-4 text-slate-400">
                                Tenda Eiger 4P, Matras (2)
                            </td>
                            <td class="px-6 py-4 font-bold text-white">
                                Rp 140.000
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button @click="openDetail(1)" class="px-4 py-2 bg-ops-500 hover:bg-ops-600 text-white rounded-lg text-xs font-bold transition shadow-lg shadow-ops-500/20">
                                    Review Pengajuan
                                </button>
                            </td>
                        </tr>

                        <!-- Item 2 -->
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img class="h-9 w-9 rounded-full object-cover border border-ops-500/30" src="https://ui-avatars.com/api/?name=Ahmad+Dani&background=random" alt="Avatar">
                                    <div>
                                        <div class="font-bold text-white">Ahmad Dani</div>
                                        <div class="text-xs text-slate-500">Mahasiswa</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-300">
                                <div>23 Okt - 25 Okt</div>
                                <div class="text-xs text-ops-400 font-bold">2 Hari</div>
                            </td>
                            <td class="px-6 py-4 text-slate-400">
                                Carrier Deuter 65L, Headlamp
                            </td>
                            <td class="px-6 py-4 font-bold text-white">
                                Rp 110.000
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button @click="openDetail(2)" class="px-4 py-2 bg-ops-500 hover:bg-ops-600 text-white rounded-lg text-xs font-bold transition shadow-lg shadow-ops-500/20">
                                    Review Pengajuan
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- ================= MODALS ================= -->

        <!-- 1. DETAIL & REVIEW MODAL -->
        <div x-show="showDetailModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showDetailModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-black/80 transition-opacity" @click="showDetailModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                
                <div class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl w-full">
                    
                    <!-- Header -->
                    <div class="bg-dark-800 p-6 border-b border-white/5 flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-bold text-white">Review Pengajuan</h3>
                            <p class="text-sm text-slate-400">ID Pengajuan: <span class="font-mono text-ops-400">#REQ-2024-001</span></p>
                        </div>
                        <button @click="showDetailModal = false" class="text-slate-400 hover:text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                    </div>

                    <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
                        
                        <!-- Left: Borrower Profile -->
                        <div class="space-y-6">
                            <div class="bg-dark-950 p-4 rounded-xl border border-white/5 text-center">
                                <img class="h-20 w-20 rounded-full object-cover mx-auto mb-3 border-2 border-ops-500" src="https://ui-avatars.com/api/?name=Rina+Wati&background=random&size=128" alt="User">
                                <h4 class="text-lg font-bold text-white">Rina Wati</h4>
                                <p class="text-xs text-slate-400 mb-4">rina@email.com</p>
                                
                                <div class="text-left space-y-2 text-sm border-t border-white/5 pt-4">
                                    <div class="flex justify-between">
                                        <span class="text-slate-500">No. HP</span>
                                        <span class="text-slate-300">0812-3456-7890</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-500">KTP</span>
                                        <span class="text-slate-300">3201123456780001</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-500">Alamat</span>
                                        <span class="text-slate-300 text-right w-32 truncate">Jl. Mawar No. 10, Jakarta Selatan</span>
                                    </div>
                                </div>
                                <button class="w-full mt-4 py-2 bg-white/5 hover:bg-white/10 text-xs font-bold text-slate-300 rounded-lg transition border border-white/10">
                                    Lihat Scan KTP
                                </button>
                            </div>

                            <!-- Alert Check (Simulasi) -->
                            <div class="bg-red-500/10 border border-red-500/20 p-4 rounded-xl">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <div>
                                        <h5 class="text-xs font-bold text-red-400 uppercase mb-1">Riwayat Buruk</h5>
                                        <p class="text-xs text-slate-400 leading-relaxed">User pernah terlambat 2 kali dalam 3 bulan terakhir.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Request Details -->
                        <div class="lg:col-span-2 space-y-6">
                            
                            <!-- Timeline -->
                            <div class="flex items-center justify-between bg-dark-950 p-4 rounded-xl border border-white/5">
                                <div>
                                    <p class="text-xs text-slate-500 uppercase font-bold">Tanggal Ambil</p>
                                    <p class="text-white font-medium">22 Okt 2024</p>
                                    <p class="text-xs text-slate-500">09:00 WIB</p>
                                </div>
                                <div class="flex-1 px-4 flex flex-col items-center">
                                    <div class="w-full h-0.5 bg-white/10 relative">
                                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-2 h-2 rounded-full bg-ops-500"></div>
                                        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-2 h-2 rounded-full bg-ops-500"></div>
                                    </div>
                                    <span class="text-xs font-bold text-ops-400 bg-ops-500/10 px-2 py-0.5 rounded mt-2">2 Hari</span>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-slate-500 uppercase font-bold">Tanggal Kembali</p>
                                    <p class="text-white font-medium">24 Okt 2024</p>
                                    <p class="text-xs text-slate-500">17:00 WIB</p>
                                </div>
                            </div>

                            <!-- Items Table -->
                            <div>
                                <h4 class="text-sm font-bold text-white mb-3">Rincian Barang</h4>
                                <div class="bg-dark-950 border border-white/5 rounded-xl overflow-hidden">
                                    <table class="w-full text-left text-sm">
                                        <thead class="bg-white/5 text-slate-400 text-xs uppercase font-bold">
                                            <tr>
                                                <th class="px-4 py-3">Nama Alat</th>
                                                <th class="px-4 py-3 text-center">Stok Gudang</th>
                                                <th class="px-4 py-3 text-center">Qty</th>
                                                <th class="px-4 py-3 text-right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-white/5 text-slate-300">
                                            <tr>
                                                <td class="px-4 py-3">
                                                    <div class="font-medium text-white">Tenda Eiger 4P</div>
                                                    <div class="text-xs text-slate-500">Kategori: Tenda</div>
                                                </td>
                                                <td class="px-4 py-3 text-center text-emerald-500 font-bold">5</td>
                                                <td class="px-4 py-3 text-center">1</td>
                                                <td class="px-4 py-3 text-right">Rp 100.000</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-3">
                                                    <div class="font-medium text-white">Matras Foil</div>
                                                    <div class="text-xs text-slate-500">Kategori: Aksesoris</div>
                                                </td>
                                                <td class="px-4 py-3 text-center text-emerald-500 font-bold">20</td>
                                                <td class="px-4 py-3 text-center">2</td>
                                                <td class="px-4 py-3 text-right">Rp 40.000</td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="bg-white/5 border-t border-white/10">
                                            <tr>
                                                <td colspan="3" class="px-4 py-3 text-right font-bold text-slate-400">Total Estimasi</td>
                                                <td class="px-4 py-3 text-right font-bold text-white text-lg">Rp 140.000</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-3 pt-4 border-t border-white/5">
                                <button @click="showDetailModal = false; showRejectModal = true" class="flex-1 py-3 border border-red-500/30 text-red-500 hover:bg-red-500 hover:text-white rounded-xl font-bold transition text-sm">
                                    Tolak Pengajuan
                                </button>
                                <form action="#" method="POST" class="flex-1"> <!-- Route Approve -->
                                    @csrf
                                    <button type="submit" class="w-full py-3 bg-ops-600 hover:bg-ops-500 text-white rounded-xl font-bold transition text-sm shadow-lg shadow-ops-500/20">
                                        Setujui Pengajuan
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. REJECT REASON MODAL -->
        <div x-show="showRejectModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-black/80 transition-opacity" @click="showRejectModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                
                <div class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full">
                    <form action="#" method="POST" class="p-6"> <!-- Route Reject -->
                        @csrf
                        <div class="text-center mb-6">
                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-500/10 mb-4">
                                <svg class="h-6 w-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            </div>
                            <h3 class="text-lg font-bold text-white">Tolak Pengajuan?</h3>
                            <p class="text-sm text-slate-400">Berikan alasan penolakan agar peminjam dapat memperbaikinya.</p>
                        </div>

                        <div class="mb-6">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Alasan Penolakan</label>
                            <textarea name="reason" rows="3" class="w-full bg-dark-800 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:ring-red-500 focus:border-red-500" placeholder="Contoh: Stok barang tidak mencukupi, KTP buram, dll..." required></textarea>
                        </div>

                        <div class="flex gap-3">
                            <button type="button" @click="showRejectModal = false; showDetailModal = true" class="flex-1 py-2.5 bg-white/5 hover:bg-white/10 text-slate-300 rounded-lg text-sm font-bold transition">
                                Batal
                            </button>
                            <button type="submit" class="flex-1 py-2.5 bg-red-600 hover:bg-red-500 text-white rounded-lg text-sm font-bold transition shadow-lg shadow-red-500/20">
                                Konfirmasi Tolak
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection