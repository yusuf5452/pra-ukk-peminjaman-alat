@extends('layouts.admin')

@section('header', 'Kategori Alat Outdoor')

@section('content')
    <div x-data="{ 
        showCreateModal: false,
        showEditModal: false,
        showDeleteModal: false,
        search: '{{ request('search') }}',
        
        // Data untuk Edit/Delete
        editData: { id: null, nama: '', deskripsi: '' },
        deleteUrl: '',
        
        // Fungsi helper untuk membuka modal edit dengan data
        openEditModal(item) {
            this.editData = {
                id: item.id_kategori,
                nama: item.nama_kategori,
                deskripsi: item.deskripsi
            };
            // Set action URL form secara dinamis
            this.$nextTick(() => {
                document.getElementById('editForm').action = '/admin/kategori/' + item.id_kategori;
            });
            this.showEditModal = true;
        },

        // Fungsi helper untuk membuka modal delete
        openDeleteModal(id) {
            this.deleteUrl = '/admin/kategori/' + id;
            this.showDeleteModal = true;
        }
    }">

        <!-- Alert Notification -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 text-sm font-bold flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-500 text-sm font-bold flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
        @endif

        <!-- Top Action Bar -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
            
            <!-- Statistics -->
            <div class="flex gap-2">
                <span class="px-4 py-2 rounded-lg bg-brand-500/10 text-brand-500 border border-brand-500/20 text-xs font-bold uppercase tracking-wider">
                    Total Kategori: {{ $totalKategori ?? 0 }}
                </span>
            </div>

            <!-- Search & Add -->
            <div class="flex items-center gap-3 w-full md:w-auto">
                <form action="{{ route('admin.kategori.index') }}" method="GET" class="relative group flex-1 md:w-64">
                    <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-slate-500 group-focus-within:text-brand-500 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..." class="bg-dark-800/50 border border-white/10 text-white text-sm rounded-xl focus:ring-brand-500 focus:border-brand-500 block w-full pl-10 p-2.5 placeholder-slate-500 transition-all">
                </form>
                
                <button @click="showCreateModal = true" class="flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-dark-950 font-bold py-2.5 px-5 rounded-xl transition-all shadow-[0_0_20px_rgba(0,220,130,0.3)] hover:shadow-[0_0_30px_rgba(0,220,130,0.5)]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span class="hidden md:inline">Tambah Kategori</span>
                </button>
            </div>
        </div>

        <!-- CONTENT GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            @forelse($kategori as $item)
            <!-- Item Card -->
            <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 hover:border-brand-500/30 transition-all group relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                    <!-- Icon dekoratif -->
                    <svg class="w-24 h-24 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm0 3.5L18.5 20h-13L12 5.5z"/></svg>
                </div>
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-4">
                        <div class="h-12 w-12 rounded-xl bg-brand-500/10 flex items-center justify-center text-brand-500 border border-brand-500/20">
                            <!-- Inisial Huruf Depan -->
                            <span class="text-xl font-bold">{{ substr($item->nama_kategori, 0, 1) }}</span>
                        </div>
                        <div class="flex gap-2">
                            <!-- Button Edit: passing data JSON ke Alpine -->
                            <button @click="openEditModal({{ json_encode($item) }})" class="p-2 text-slate-400 hover:text-white hover:bg-white/10 rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </button>
                            <!-- Button Delete -->
                            <button @click="openDeleteModal('{{ $item->id_kategori }}')" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-500/10 rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">{{ $item->nama_kategori }}</h3>
                    <p class="text-sm text-slate-400 mb-4 line-clamp-2 min-h-[40px]">
                        {{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}
                    </p>
                    <div class="flex items-center gap-2 text-xs font-bold text-brand-500 bg-brand-500/10 px-3 py-1.5 rounded-lg w-fit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        {{ $item->alat_count ?? 0 }} Item Terdaftar
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center text-slate-500">
                <p>Belum ada kategori data.</p>
            </div>
            @endforelse

        </div>

        <!-- ================= MODALS ================= -->

        <!-- 1. CREATE KATEGORI MODAL -->
        <div x-show="showCreateModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showCreateModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-black/80 transition-opacity" @click="showCreateModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <div x-show="showCreateModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full">
                    <form action="{{ route('admin.kategori.store') }}" method="POST" class="p-6">
                        @csrf
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-white">Tambah Kategori</h3>
                            <button type="button" @click="showCreateModal = false" class="text-slate-400 hover:text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-400 mb-1">Nama Kategori</label>
                                <input type="text" name="nama_kategori" placeholder="Contoh: Matras & Sleeping Bag" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-400 mb-1">Deskripsi</label>
                                <textarea name="deskripsi" rows="3" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500" placeholder="Jelaskan kategori ini secara singkat..."></textarea>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end gap-3 border-t border-white/10 pt-4">
                            <button type="button" @click="showCreateModal = false" class="px-4 py-2 bg-white/5 hover:bg-white/10 text-slate-300 rounded-lg transition-colors text-sm font-bold">Batal</button>
                            <button type="submit" class="px-6 py-2 bg-brand-500 hover:bg-brand-600 text-dark-950 rounded-lg transition-colors text-sm font-bold">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- 2. EDIT KATEGORI MODAL -->
        <div x-show="showEditModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-black/80 transition-opacity" @click="showEditModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full">
                    
                    <!-- Form Action diupdate lewat Alpine.js -->
                    <form id="editForm" method="POST" class="p-6">
                        @csrf @method('PUT')
                        <h3 class="text-lg font-bold text-white mb-6">Edit Kategori</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-400 mb-1">Nama Kategori</label>
                                <input type="text" name="nama_kategori" x-model="editData.nama" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-400 mb-1">Deskripsi</label>
                                <textarea name="deskripsi" x-model="editData.deskripsi" rows="3" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500"></textarea>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end gap-3 border-t border-white/10 pt-4">
                            <button type="button" @click="showEditModal = false" class="px-4 py-2 bg-white/5 hover:bg-white/10 text-slate-300 rounded-lg transition-colors text-sm font-bold">Batal</button>
                            <button type="submit" class="px-6 py-2 bg-brand-500 hover:bg-brand-600 text-dark-950 rounded-lg transition-colors text-sm font-bold">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- 3. DELETE CONFIRMATION MODAL -->
        <div x-show="showDeleteModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-black/80 transition-opacity" @click="showDeleteModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm w-full p-6">
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-500/10 mb-4">
                            <svg class="h-6 w-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <h3 class="text-lg leading-6 font-bold text-white mb-2">Hapus Kategori Ini?</h3>
                        <p class="text-sm text-slate-400">Pastikan tidak ada alat yang terhubung dengan kategori ini sebelum menghapus. Data yang dihapus tidak dapat dikembalikan.</p>
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