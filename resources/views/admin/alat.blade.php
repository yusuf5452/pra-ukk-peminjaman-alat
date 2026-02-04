@extends('layouts.admin')

@section('header', 'Manajemen Alat Outdoor')

@section('content')
    <div x-data="{ 
        showCreateModal: false,
        showEditModal: false,
        showDeleteModal: false,
        search: '{{ request('search') }}',
        
        // Objek untuk menampung data yang akan diedit
        editData: {
            id: null,
            nama: '',
            kategori_id: '',
            stok: 0,
            harga_sewa: 0,
            harga_denda: 0,
            deskripsi: ''
        },
        deleteUrl: '',

        // Fungsi mengisi form edit saat tombol diklik
        openEditModal(item) {
            this.editData = {
                id: item.id_alat,
                nama: item.nama_alat,
                kategori_id: item.id_kategori,
                stok: item.stok,
                harga_sewa: item.harga_sewa_per_hari,
                harga_denda: item.harga_denda_per_hari,
                deskripsi: item.deskripsi
            };
            
            // Ubah action form secara dinamis ke route update yang sesuai ID
            this.$nextTick(() => {
                document.getElementById('editForm').action = '/admin/alat/' + item.id_alat;
            });
            this.showEditModal = true;
        },

        // Fungsi set URL delete
        openDeleteModal(id) {
            this.deleteUrl = '/admin/alat/' + id;
            this.showDeleteModal = true;
        }
    }">

        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 text-sm font-bold flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Top Action Bar -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
            
            <!-- Statistics -->
            <div class="flex gap-2">
                <span class="px-4 py-2 rounded-lg bg-brand-500/10 text-brand-500 border border-brand-500/20 text-xs font-bold uppercase tracking-wider">
                    Total Alat: {{ $totalAlat ?? 0 }} Item
                </span>
                <span class="px-4 py-2 rounded-lg bg-blue-500/10 text-blue-500 border border-blue-500/20 text-xs font-bold uppercase tracking-wider">
                    Total Stok: {{ $totalStok ?? 0 }} Unit
                </span>
            </div>

            <!-- Search & Add -->
            <div class="flex items-center gap-3 w-full md:w-auto">
                <form action="{{ route('admin.alat.index') }}" method="GET" class="relative group flex-1 md:w-64">
                    <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-slate-500 group-focus-within:text-brand-500 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari alat..." class="bg-dark-800/50 border border-white/10 text-white text-sm rounded-xl focus:ring-brand-500 focus:border-brand-500 block w-full pl-10 p-2.5 placeholder-slate-500 transition-all">
                </form>
                
                <button @click="showCreateModal = true" class="flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-dark-950 font-bold py-2.5 px-5 rounded-xl transition-all shadow-[0_0_20px_rgba(0,220,130,0.3)] hover:shadow-[0_0_30px_rgba(0,220,130,0.5)]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span class="hidden md:inline">Tambah Alat</span>
                </button>
            </div>
        </div>

        <!-- CONTENT GRID -->
        <div class="bg-dark-800/50 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-sm">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-xs uppercase text-slate-400 font-bold">
                    <tr>
                        <th class="px-6 py-4">Detail Alat</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Stok</th>
                        <th class="px-6 py-4">Harga (24 Jam)</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($alat as $item)
                    <tr class="hover:bg-white/5 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-lg bg-dark-900 border border-white/10 overflow-hidden flex-shrink-0 relative">
                                    @if($item->gambar)
                                        <img class="h-full w-full object-cover" src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_alat }}">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center bg-white/5 text-slate-500 text-[10px]">No Img</div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-white font-bold text-sm">{{ $item->nama_alat }}</div>
                                    <div class="text-xs text-slate-500 truncate w-40">{{ $item->deskripsi }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/5 text-slate-300 border border-white/10">
                                {{ $item->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-white">{{ $item->stok }} Unit</span>
                                @if($item->stok > 5)
                                    <span class="text-xs text-emerald-500">Tersedia</span>
                                @elseif($item->stok > 0)
                                    <span class="text-xs text-yellow-500">Menipis</span>
                                @else
                                    <span class="text-xs text-red-500">Habis</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-brand-500">Rp {{ number_format($item->harga_sewa_per_hari, 0, ',', '.') }}</span>
                                <span class="text-xs text-slate-500">Denda: Rp {{ number_format($item->harga_denda_per_hari, 0, ',', '.') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button @click="openEditModal({{ json_encode($item) }})" class="text-slate-400 hover:text-white transition-colors mr-2 p-2 hover:bg-white/10 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </button>
                            <button @click="openDeleteModal('{{ $item->id_alat }}')" class="text-slate-400 hover:text-red-500 transition-colors p-2 hover:bg-red-500/10 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                            Belum ada data alat. Silakan tambah alat baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ================= MODALS ================= -->

        <!-- 1. CREATE ALAT MODAL -->
        <div x-show="showCreateModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-black/80 transition-opacity" @click="showCreateModal = false"></div>
                <div class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">
                    <form action="{{ route('admin.alat.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                        @csrf
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-white">Tambah Alat Baru</h3>
                            <button type="button" @click="showCreateModal = false" class="text-slate-400 hover:text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-400 mb-1">Foto Alat</label>
                                    <input type="file" name="foto" class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-brand-500 file:text-dark-950 hover:file:bg-brand-400"/>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-400 mb-1">Nama Alat</label>
                                    <input type="text" name="nama" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-400 mb-1">Kategori</label>
                                    <select name="kategori_id" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategori as $kat)
                                            <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-400 mb-1">Stok Tersedia</label>
                                    <input type="number" name="stok" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500" required>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-400 mb-1">Harga Sewa</label>
                                        <input type="number" name="harga_sewa" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-400 mb-1">Denda</label>
                                        <input type="number" name="harga_denda" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500" required>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-400 mb-1">Deskripsi Singkat</label>
                                    <textarea name="deskripsi" rows="3" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end gap-3 border-t border-white/10 pt-4">
                            <button type="button" @click="showCreateModal = false" class="px-4 py-2 bg-white/5 hover:bg-white/10 text-slate-300 rounded-lg transition-colors text-sm font-bold">Batal</button>
                            <button type="submit" class="px-6 py-2 bg-brand-500 hover:bg-brand-600 text-dark-950 rounded-lg transition-colors text-sm font-bold">Simpan Alat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- 2. EDIT ALAT MODAL -->
        <div x-show="showEditModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-black/80 transition-opacity" @click="showEditModal = false"></div>
                <div class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">
                    
                    <form id="editForm" method="POST" enctype="multipart/form-data" class="p-6">
                        @csrf @method('PUT')
                        <h3 class="text-lg font-bold text-white mb-6">Edit Data Alat</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-400 mb-1">Nama Alat</label>
                                    <input type="text" name="nama" x-model="editData.nama" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-400 mb-1">Kategori</label>
                                    <select name="kategori_id" x-model="editData.kategori_id" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500">
                                        @foreach($kategori as $kat)
                                            <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-400 mb-1">Update Foto (Opsional)</label>
                                    <input type="file" name="foto" class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-brand-500 file:text-dark-950 hover:file:bg-brand-400"/>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-400 mb-1">Stok</label>
                                    <input type="number" name="stok" x-model="editData.stok" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-400 mb-1">Harga Sewa</label>
                                        <input type="number" name="harga_sewa" x-model="editData.harga_sewa" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-400 mb-1">Denda</label>
                                        <input type="number" name="harga_denda" x-model="editData.harga_denda" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-400 mb-1">Deskripsi</label>
                                    <textarea name="deskripsi" x-model="editData.deskripsi" rows="2" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end gap-3 border-t border-white/10 pt-4">
                            <button type="button" @click="showEditModal = false" class="px-4 py-2 bg-white/5 hover:bg-white/10 text-slate-300 rounded-lg transition-colors text-sm font-bold">Batal</button>
                            <button type="submit" class="px-6 py-2 bg-brand-500 hover:bg-brand-600 text-dark-950 rounded-lg transition-colors text-sm font-bold">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- 3. DELETE CONFIRMATION MODAL -->
        <div x-show="showDeleteModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-black/80 transition-opacity" @click="showDeleteModal = false"></div>
                <div class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm w-full p-6">
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-500/10 mb-4">
                            <svg class="h-6 w-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <h3 class="text-lg leading-6 font-bold text-white mb-2">Hapus Alat Ini?</h3>
                        <p class="text-sm text-slate-400">Data alat yang dihapus tidak dapat dikembalikan.</p>
                    </div>
                    <div class="mt-6 flex justify-center gap-3">
                        <button @click="showDeleteModal = false" class="px-4 py-2 bg-white/5 hover:bg-white/10 text-slate-300 rounded-lg transition-colors text-sm font-bold">Batal</button>
                        <form :action="deleteUrl" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors text-sm font-bold">Ya, Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection