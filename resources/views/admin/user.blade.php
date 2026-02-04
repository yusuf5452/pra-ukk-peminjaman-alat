@extends('layouts.admin')

@section('header', 'Manajemen User')

@section('content')
    <div x-data="{ 
        activeTab: 'petugas', 
        showCreateModal: false,
        showEditModal: false,
        showDeleteModal: false,
        search: ''
    }">

        <!-- Top Action Bar -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
            
            <!-- Tab Switcher -->
            <div class="bg-dark-800/50 p-1 rounded-xl flex border border-white/5 relative">
                <button 
                    @click="activeTab = 'petugas'" 
                    :class="activeTab === 'petugas' ? 'bg-brand-500 text-dark-950 shadow-lg' : 'text-slate-400 hover:text-white'"
                    class="px-6 py-2 rounded-lg text-sm font-bold transition-all duration-300 w-32 relative z-10">
                    Petugas
                </button>
                <button 
                    @click="activeTab = 'peminjam'" 
                    :class="activeTab === 'peminjam' ? 'bg-brand-500 text-dark-950 shadow-lg' : 'text-slate-400 hover:text-white'"
                    class="px-6 py-2 rounded-lg text-sm font-bold transition-all duration-300 w-32 relative z-10">
                    Peminjam
                </button>
            </div>

            <!-- Search & Add -->
            <div class="flex items-center gap-3 w-full md:w-auto">
                <div class="relative group flex-1 md:w-64">
                    <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-slate-500 group-focus-within:text-brand-500 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input x-model="search" type="text" placeholder="Cari user..." class="bg-dark-800/50 border border-white/10 text-white text-sm rounded-xl focus:ring-brand-500 focus:border-brand-500 block w-full pl-10 p-2.5 placeholder-slate-500 transition-all">
                </div>
                
                <button @click="showCreateModal = true" class="flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-dark-950 font-bold py-2.5 px-5 rounded-xl transition-all shadow-[0_0_20px_rgba(0,220,130,0.3)] hover:shadow-[0_0_30px_rgba(0,220,130,0.5)]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span class="hidden md:inline">Tambah User</span>
                </button>
            </div>
        </div>

        <!-- TAB CONTENT: PETUGAS -->
        <div x-show="activeTab === 'petugas'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="bg-dark-800/50 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-sm">
                <table class="w-full text-left">
                    <thead class="bg-white/5 text-xs uppercase text-slate-400 font-bold">
                        <tr>
                            <th class="px-6 py-4">User Info</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Status Akun</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        <!-- Item 1 (Admin) -->
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <img class="w-10 h-10 rounded-full border border-brand-500/50" src="https://ui-avatars.com/api/?name=Admin+Utama&background=00dc82&color=000" alt="Avatar">
                                    <div>
                                        <div class="text-white font-bold">Admin Utama</div>
                                        <div class="text-xs text-slate-500">admin@outdoor.rent</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-purple-500/10 text-purple-400 border border-purple-500/20">Administrator</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                                    <span class="text-sm text-brand-500">Aktif</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button @click="showEditModal = true" class="text-slate-400 hover:text-white transition-colors mr-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                            </td>
                        </tr>
                        <!-- Item 2 (Petugas) -->
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <img class="w-10 h-10 rounded-full border border-blue-500/50" src="https://ui-avatars.com/api/?name=Budi+Santoso&background=3b82f6&color=fff" alt="Avatar">
                                    <div>
                                        <div class="text-white font-bold">Budi Santoso</div>
                                        <div class="text-xs text-slate-500">budi@outdoor.rent</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20">Petugas</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                                    <span class="text-sm text-brand-500">Aktif</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button @click="showEditModal = true" class="text-slate-400 hover:text-white transition-colors mr-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                                <button @click="showDeleteModal = true" class="text-slate-400 hover:text-red-500 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TAB CONTENT: PEMINJAM -->
        <div x-show="activeTab === 'peminjam'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
            <div class="bg-dark-800/50 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-sm">
                <table class="w-full text-left">
                    <thead class="bg-white/5 text-xs uppercase text-slate-400 font-bold">
                        <tr>
                            <th class="px-6 py-4">User Info</th>
                            <th class="px-6 py-4">Kontak</th>
                            <th class="px-6 py-4">Status Akun</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        <!-- Item 1 (Peminjam) -->
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <img class="w-10 h-10 rounded-full border border-orange-500/50" src="https://ui-avatars.com/api/?name=Rina+Wati&background=f97316&color=fff" alt="Avatar">
                                    <div>
                                        <div class="text-white font-bold">Rina Wati</div>
                                        <div class="text-xs text-slate-500">Member sejak 2024</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-slate-300">rina@gmail.com</div>
                                <div class="text-xs text-slate-500">0812-3456-7890</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                                    <span class="text-sm text-brand-500">Aktif</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button @click="showEditModal = true" class="text-slate-400 hover:text-white transition-colors mr-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                                <button @click="showDeleteModal = true" class="text-slate-400 hover:text-red-500 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                            </td>
                        </tr>
                        <!-- Item 2 (Peminjam Non-Aktif) -->
                        <tr class="hover:bg-white/5 transition-colors group bg-red-500/5">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <img class="w-10 h-10 rounded-full border border-red-500/50" src="https://ui-avatars.com/api/?name=Joko+Anwar&background=ef4444&color=fff" alt="Avatar">
                                    <div>
                                        <div class="text-white font-bold">Joko Anwar</div>
                                        <div class="text-xs text-red-400">Suspended</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-slate-300">joko@gmail.com</div>
                                <div class="text-xs text-slate-500">0899-8888-7777</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                    <span class="text-sm text-red-500">Non-Aktif</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button @click="showEditModal = true" class="text-slate-400 hover:text-white transition-colors mr-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                                <button @click="showDeleteModal = true" class="text-slate-400 hover:text-red-500 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ================= MODALS ================= -->

        <!-- 1. CREATE USER MODAL -->
        <div x-show="showCreateModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showCreateModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/80 transition-opacity" aria-hidden="true" @click="showCreateModal = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showCreateModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                    <form action="{{ route('admin.users.store') }}" method="POST" class="p-6">
                        @csrf
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-white" id="modal-title">Tambah User Baru</h3>
                            <button type="button" @click="showCreateModal = false" class="text-slate-400 hover:text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-400 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-400 mb-1">Username</label>
                                <input type="text" name="username" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500" required>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-400 mb-1">Role</label>
                                    <select name="role" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500">
                                        <option value="admin">Admin</option>
                                        <option value="petugas">Petugas</option>
                                        <option value="peminjam" selected>Peminjam</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-400 mb-1">Status</label>
                                    <select name="status" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500">
                                        <option value="1">Aktif</option>
                                        <option value="0">Non-Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-400 mb-1">Password</label>
                                <input type="password" name="password" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500" required>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end gap-3">
                            <button type="button" @click="showCreateModal = false" class="px-4 py-2 bg-white/5 hover:bg-white/10 text-slate-300 rounded-lg transition-colors text-sm font-bold">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-brand-500 hover:bg-brand-600 text-dark-950 rounded-lg transition-colors text-sm font-bold">Simpan User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- 2. EDIT USER MODAL (Similar structure) -->
        <div x-show="showEditModal" style="display: none;" class="fixed inset-0 z-[999] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-black/80 transition-opacity" @click="showEditModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="inline-block align-bottom bg-dark-900 border border-white/10 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                    <form action="#" method="POST" class="p-6"> <!-- Nanti update route dinamis -->
                        @csrf @method('PUT')
                        <h3 class="text-lg font-bold text-white mb-6">Edit Data User</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-400 mb-1">Nama Lengkap</label>
                                <input type="text" value="Budi Santoso" class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-brand-500 focus:border-brand-500">
                            </div>
                            <!-- More inputs... -->
                            <div>
                                <label class="block text-sm font-medium text-slate-400 mb-1">Role</label>
                                <select class="w-full bg-dark-800 border border-white/10 rounded-lg px-4 py-2 text-white">
                                    <option value="petugas" selected>Petugas</option>
                                    <option value="peminjam">Peminjam</option>
                                </select>
                            </div>
                             <div class="flex items-center gap-3 border border-white/10 p-3 rounded-lg">
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-white">Status Akun</label>
                                    <p class="text-xs text-slate-500">Matikan untuk memblokir akses user.</p>
                                </div>
                                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                    <input type="checkbox" name="is_active" id="toggle" class="toggle-checkbox absolute block w-5 h-5 rounded-full bg-white border-4 appearance-none cursor-pointer checked:right-0 right-5" checked/>
                                    <label for="toggle" class="toggle-label block overflow-hidden h-5 rounded-full bg-brand-500 cursor-pointer"></label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end gap-3">
                            <button type="button" @click="showEditModal = false" class="px-4 py-2 bg-white/5 hover:bg-white/10 text-slate-300 rounded-lg transition-colors text-sm font-bold">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-brand-500 hover:bg-brand-600 text-dark-950 rounded-lg transition-colors text-sm font-bold">Update</button>
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
                        <h3 class="text-lg leading-6 font-bold text-white mb-2">Hapus User Ini?</h3>
                        <p class="text-sm text-slate-400">Tindakan ini tidak dapat dibatalkan. Semua data terkait user ini mungkin akan terpengaruh.</p>
                    </div>
                    <div class="mt-6 flex justify-center gap-3">
                        <button @click="showDeleteModal = false" class="px-4 py-2 bg-white/5 hover:bg-white/10 text-slate-300 rounded-lg transition-colors text-sm font-bold">Batal</button>
                        <button class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors text-sm font-bold">Ya, Hapus</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection