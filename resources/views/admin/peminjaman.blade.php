@extends('layouts.admin')

@section('header', 'Data Peminjaman')

@section('content')
    <div x-data="{ 
        showDetailModal: false,
        showStatusModal: false,
        activeFilter: 'all',
        search: '',
        selectedTransaction: null
    }">

        <!-- Top Action Bar -->
        <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center gap-4 mb-8">
            
            <!-- Status Filters -->
            <div class="flex flex-wrap gap-2">
                <button @click="activeFilter = 'all'" 
                    :class="activeFilter === 'all' ? 'bg-brand-500 text-dark-950 border-brand-500' : 'bg-white/5 text-slate-400 border-white/10 hover:bg-white/10'"
                    class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider border transition-all">
                    Semua
                </button>
                <button @click="activeFilter = 'pending'" 
                    :class="activeFilter === 'pending' ? 'bg-yellow-500 text-dark-950 border-yellow-500' : 'bg-white/5 text-slate-400 border-white/10 hover:bg-white/10'"
                    class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider border transition-all">
                    Pending
                </button>
                <button @click="activeFilter = 'approved'" 
                    :class="activeFilter === 'approved' ? 'bg-blue-500 text-white border-blue-500' : 'bg-white/5 text-slate-400 border-white/10 hover:bg-white/10'"
                    class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider border transition-all">
                    Disetujui
                </button>
                <button @click="activeFilter = 'active'" 
                    :class="activeFilter === 'active' ? 'bg-emerald-500 text-dark-950 border-emerald-500' : 'bg-white/5 text-slate-400 border-white/10 hover:bg-white/10'"
                    class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider border transition-all">
                    Sedang Dipinjam
                </button>
                <button @click="activeFilter = 'completed'" 
                    :class="activeFilter === 'completed' ? 'bg-slate-500 text-white border-slate-500' : 'bg-white/5 text-slate-400 border-white/10 hover:bg-white/10'"
                    class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider border transition-all">
                    Selesai
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

        <!-- TRANSACTIONS TABLE -->
        <div class="bg-dark-800/50 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-sm overflow-x-auto">
            <table class="w-full text-left min-w-[1000px]">
                <thead class="bg-white/5 text-xs uppercase text-slate-400 font-bold">
                    <tr>
                        <th class="px-6 py-4">Kode Trx</th>
                        <th class="px-6 py-4">Peminjam</th>
                        <th class="px-6 py-4">Item Alat</th>
                        <th class="px-6 py-4">Tanggal Pinjam</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Total Biaya</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 text-sm">
                    
                    <!-- Row 1: Pending -->
                    <tr class="hover:bg-white/5 transition-colors group">
                        <td class="px-6 py-4 font-mono text-brand-500">#TRX-8821</td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-white">Rina Wati</div>
                            <div class="text-xs text-slate-500">0812-3456-7890</div>
                        </td>
                        <td class="px-6 py-4 text-slate-300">
                            Tenda Eiger 4P, Matras (2)
                        </td>
                        <td class="px-6 py-4 text-slate-300">
                            20 Okt - 22 Okt 2024
                            <div class="text-xs text-slate-500">(2 Hari)</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-yellow-500/10 text-yellow-500 border border-yellow-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span> Pending
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right font-bold text-white">Rp 150.000</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button @click="showDetailModal = true" class="p-2 text-slate-400 hover:text-white hover:bg-white/10 rounded-lg transition" title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </button>
                                <button @click="showStatusModal = true" class="p-2 text-slate-400 hover:text-brand-500 hover:bg-brand-500/10 rounded-lg transition" title="Update Status">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2: Sedang Dipinjam -->
                    <tr class="hover:bg-white/5 transition-colors group">
                        <td class="px-6 py-4 font-mono text-brand-500">#TRX-8820</td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-white">Budi Santoso</div>
                            <div class="text-xs text-slate-500">0899-8888-7777</div>
                        </td>
                        <td class="px-6 py-4 text-slate-300">
                            Carrier Osprey 60L
                        </td>
                        <td class="px-6 py-4 text-slate-300">
                            18 Okt - 21 Okt 2024
                            <div class="text-xs text-slate-500">(3 Hari)</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-500/10 text-emerald-500 border border-emerald-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Dipinjam
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right font-bold text-white">Rp 135.000</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button @click="showDetailModal = true" class="p-2 text-slate-400 hover:text-white hover:bg-white/10 rounded-lg transition" title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </button>
                                <!-- Tombol Update Status Disabled untuk Admin jika mau -->
                                <button @click="showStatusModal = true" class="p-2 text-slate-400 hover:text-brand-500 hover:bg-brand-500/10 rounded-lg transition" title="Update Status">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3: Selesai -->
                    <tr class="hover:bg-white/5 transition-colors group opacity-70 hover:opacity-100">
                        <td class="px-6 py-4 font-mono text-slate-500">#TRX-8819</td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-white">Siti Aminah</div>
                            <div class="text-xs text-slate-500">0811-2233-4455</div>
                        </td>
                        <td class="px-6 py-4 text-slate-300">
                            Kompor Portable, Nesting
                        </td>
                        <td class="px-6 py-4 text-slate-300">
                            15 Okt - 16 Okt 2024
                            <div class="text-xs text-slate-500">(1 Hari)</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-slate-700 text-slate-300 border border-slate-600">
                                Selesai
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right font-bold text-white">Rp 45.000</td>
                        <td class="px-6 py-4 text-center">
                            <button @click="showDetailModal = true" class="p-2 text-slate-400 hover:text-white hover:bg-white/10 rounded-lg transition" title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <!-- ================= MODALS ================= -->

        <!-- 1. DETAIL TRANSACTION MODAL -->
        <div x-show="showDetailModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showDetailModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-black/80 transition-opacity" @click="showDetailModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">
                    
                    <!-- Modal Header -->
                    <div class="bg-dark-800 p-6 border-b border-white/5 flex justify-between items-center">
                        <h3 class="text-xl font-bold text-white">Detail Transaksi <span class="text-brand-500 font-mono">#TRX-8821</span></h3>
                        <button @click="showDetailModal = false" class="text-slate-400 hover:text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="p-6 space-y-6">
                        
                        <!-- Status Banner -->
                        <div class="bg-yellow-500/10 border border-yellow-500/20 rounded-xl p-4 flex items-center gap-3">
                            <div class="p-2 bg-yellow-500 text-dark-950 rounded-full">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-yellow-500 text-sm uppercase">Menunggu Persetujuan</h4>
                                <p class="text-xs text-slate-400">Pengajuan dibuat pada 19 Okt 2024, 14:30 WIB</p>
                            </div>
                        </div>

                        <!-- User Info -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Peminjam</label>
                                <p class="text-white font-medium">Rina Wati</p>
                                <p class="text-slate-400 text-sm">rina@gmail.com</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Kontak</label>
                                <p class="text-white font-medium">0812-3456-7890</p>
                                <p class="text-slate-400 text-sm">Jl. Melati No. 45, Jakarta</p>
                            </div>
                        </div>

                        <!-- Items List -->
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-3">Detail Barang</label>
                            <div class="bg-dark-950 rounded-xl border border-white/5 overflow-hidden">
                                <table class="w-full text-left text-sm">
                                    <thead class="bg-white/5 text-slate-400">
                                        <tr>
                                            <th class="px-4 py-2">Nama Alat</th>
                                            <th class="px-4 py-2 text-center">Jml</th>
                                            <th class="px-4 py-2 text-right">Harga/Hari</th>
                                            <th class="px-4 py-2 text-right">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-white/5 text-slate-300">
                                        <tr>
                                            <td class="px-4 py-3">Tenda Eiger 4P</td>
                                            <td class="px-4 py-3 text-center">1</td>
                                            <td class="px-4 py-3 text-right">Rp 50.000</td>
                                            <td class="px-4 py-3 text-right">Rp 50.000</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3">Matras</td>
                                            <td class="px-4 py-3 text-center">2</td>
                                            <td class="px-4 py-3 text-right">Rp 10.000</td>
                                            <td class="px-4 py-3 text-right">Rp 20.000</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="bg-white/5 font-bold text-white">
                                        <tr>
                                            <td colspan="3" class="px-4 py-3 text-right">Total per Hari</td>
                                            <td class="px-4 py-3 text-right">Rp 70.000</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- Summary -->
                        <div class="bg-dark-800 p-4 rounded-xl flex justify-between items-center border border-white/5">
                            <div>
                                <p class="text-xs text-slate-500">Durasi Peminjaman</p>
                                <p class="text-white font-bold">2 Hari</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-slate-500">Grand Total</p>
                                <p class="text-xl font-display font-bold text-brand-500">Rp 140.000</p>
                            </div>
                        </div>

                    </div>
                    
                    <div class="p-6 border-t border-white/5 bg-dark-800 rounded-b-2xl flex justify-end gap-3">
                        <button class="px-4 py-2 bg-dark-950 text-white border border-white/10 rounded-lg text-sm hover:bg-white/5 transition">Cetak Invoice</button>
                        <button @click="showDetailModal = false; showStatusModal = true" class="px-4 py-2 bg-brand-500 text-dark-950 font-bold rounded-lg text-sm hover:bg-brand-600 transition">Proses Transaksi</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. EDIT STATUS MODAL -->
        <div x-show="showStatusModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-black/80 transition-opacity" @click="showStatusModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full">
                    <form action="#" method="POST" class="p-6">
                        @csrf
                        <h3 class="text-lg font-bold text-white mb-4">Update Status Transaksi</h3>
                        <p class="text-sm text-slate-400 mb-6">Ubah status transaksi <strong>#TRX-8821</strong>. Pastikan perubahan ini valid.</p>

                        <div class="space-y-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-400 mb-2">Pilih Status Baru</label>
                                <div class="grid grid-cols-1 gap-2">
                                    <label class="flex items-center p-3 border border-white/10 rounded-xl hover:bg-white/5 cursor-pointer transition">
                                        <input type="radio" name="status" value="approved" class="text-brand-500 focus:ring-brand-500 bg-dark-950 border-white/20">
                                        <span class="ml-3 text-sm text-white font-medium">Setujui (Approved)</span>
                                    </label>
                                    <label class="flex items-center p-3 border border-white/10 rounded-xl hover:bg-white/5 cursor-pointer transition">
                                        <input type="radio" name="status" value="active" class="text-brand-500 focus:ring-brand-500 bg-dark-950 border-white/20">
                                        <span class="ml-3 text-sm text-white font-medium">Barang Diambil (Sedang Dipinjam)</span>
                                    </label>
                                    <label class="flex items-center p-3 border border-white/10 rounded-xl hover:bg-white/5 cursor-pointer transition">
                                        <input type="radio" name="status" value="rejected" class="text-brand-500 focus:ring-brand-500 bg-dark-950 border-white/20">
                                        <span class="ml-3 text-sm text-red-400 font-medium">Tolak Pengajuan</span>
                                    </label>
                                    <label class="flex items-center p-3 border border-white/10 rounded-xl hover:bg-white/5 cursor-pointer transition">
                                        <input type="radio" name="status" value="cancelled" class="text-brand-500 focus:ring-brand-500 bg-dark-950 border-white/20">
                                        <span class="ml-3 text-sm text-slate-400 font-medium">Batalkan Transaksi</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-slate-400 mb-1">Catatan (Opsional)</label>
                                <textarea name="note" rows="2" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white text-sm focus:ring-brand-500 focus:border-brand-500" placeholder="Alasan penolakan atau catatan tambahan..."></textarea>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3">
                            <button type="button" @click="showStatusModal = false" class="px-4 py-2 bg-white/5 hover:bg-white/10 text-slate-300 rounded-lg transition-colors text-sm font-bold">Batal</button>
                            <button type="submit" class="px-6 py-2 bg-brand-500 hover:bg-brand-600 text-dark-950 rounded-lg transition-colors text-sm font-bold">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection