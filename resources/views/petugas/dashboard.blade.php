@extends('layouts.petugas')

@section('header', 'Dashboard Operasional')

@section('content')
    <!-- Banner -->
    <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-blue-900 to-slate-900 p-8 mb-8 border border-white/5 shadow-2xl">
        <div class="absolute right-0 top-0 h-full w-1/2 bg-[url('https://images.unsplash.com/photo-1516939884455-1445c8652f83?q=80&w=1587&auto=format&fit=crop')] bg-cover bg-center opacity-20 mix-blend-overlay mask-image-l-fade"></div>
        <div class="relative z-10">
            <h3 class="text-3xl font-display font-bold text-white mb-2">Selamat Bertugas! 🛠️</h3>
            <p class="text-blue-100 max-w-xl">Fokus hari ini: Cek pengembalian alat dan verifikasi permohonan baru secepatnya.</p>
        </div>
    </div>

    <!-- Task Widgets (Action Oriented) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <!-- Card 1: Menunggu Persetujuan (Urgent) -->
        <div class="relative overflow-hidden bg-dark-800/50 border border-yellow-500/30 rounded-2xl p-6 hover:bg-dark-800 transition-colors group">
            <div class="absolute top-0 right-0 p-3 opacity-20 group-hover:opacity-100 transition-opacity">
                <div class="w-16 h-16 bg-yellow-500 rounded-full blur-xl"></div>
            </div>
            <div class="flex items-center gap-4 mb-3 relative z-10">
                <div class="p-3 bg-yellow-500/20 text-yellow-500 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <span class="block text-2xl font-bold text-white">5</span>
                    <span class="text-xs text-yellow-500 font-bold uppercase tracking-wider">Menunggu ACC</span>
                </div>
            </div>
            <a href="#" class="text-xs text-slate-400 hover:text-white flex items-center gap-1 mt-2">
                Lihat Permohonan <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <!-- Card 2: Pengembalian Hari Ini (Action) -->
        <div class="relative overflow-hidden bg-dark-800/50 border border-brand-500/30 rounded-2xl p-6 hover:bg-dark-800 transition-colors group">
             <div class="absolute top-0 right-0 p-3 opacity-20 group-hover:opacity-100 transition-opacity">
                <div class="w-16 h-16 bg-brand-500 rounded-full blur-xl"></div>
            </div>
            <div class="flex items-center gap-4 mb-3 relative z-10">
                <div class="p-3 bg-brand-500/20 text-brand-500 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <span class="block text-2xl font-bold text-white">3</span>
                    <span class="text-xs text-brand-500 font-bold uppercase tracking-wider">Kembali Hari Ini</span>
                </div>
            </div>
             <a href="#" class="text-xs text-slate-400 hover:text-white flex items-center gap-1 mt-2">
                Proses Pengembalian <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <!-- Card 3: Sedang Dipinjam (Monitoring) -->
        <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-6">
            <div class="flex items-center gap-4 mb-3">
                <div class="p-3 bg-blue-500/20 text-blue-500 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div>
                    <span class="block text-2xl font-bold text-white">24</span>
                    <span class="text-xs text-blue-500 font-bold uppercase tracking-wider">Dipinjam Aktif</span>
                </div>
            </div>
            <p class="text-xs text-slate-500">Total alat di luar gudang</p>
        </div>

        <!-- Card 4: Perlu Pengecekan (Maintenance) -->
        <div class="bg-dark-800/50 border border-red-500/30 rounded-2xl p-6">
            <div class="flex items-center gap-4 mb-3">
                <div class="p-3 bg-red-500/20 text-red-500 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <span class="block text-2xl font-bold text-white">4</span>
                    <span class="text-xs text-red-500 font-bold uppercase tracking-wider">Perlu Dicek</span>
                </div>
            </div>
            <p class="text-xs text-slate-500">Alat dikembalikan rusak/kotor</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Action Items -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Section: Verifikasi Peminjaman -->
            <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-display font-bold text-lg text-white flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span>
                        Verifikasi Peminjaman
                    </h3>
                    <span class="text-xs font-bold bg-yellow-500/10 text-yellow-500 px-3 py-1 rounded-full border border-yellow-500/20">5 Pending</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="text-xs text-slate-500 uppercase border-b border-white/5">
                            <tr>
                                <th class="py-3 px-2">Peminjam</th>
                                <th class="py-3 px-2">Alat</th>
                                <th class="py-3 px-2">Tgl Pinjam</th>
                                <th class="py-3 px-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <!-- Item 1 -->
                            <tr class="border-b border-white/5 hover:bg-white/5 transition">
                                <td class="py-4 px-2">
                                    <div class="font-bold text-white">Rina Wati</div>
                                    <div class="text-xs text-slate-500">Member Premium</div>
                                </td>
                                <td class="py-4 px-2 text-slate-300">Tenda Great Outdoor 4P</td>
                                <td class="py-4 px-2 text-slate-300">Besok, 08:00 WIB</td>
                                <td class="py-4 px-2">
                                    <div class="flex gap-2">
                                        <button class="bg-brand-500 hover:bg-brand-600 text-dark-950 p-2 rounded-lg transition" title="Setujui">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        </button>
                                        <button class="bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white p-2 rounded-lg transition border border-red-500/20" title="Tolak">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Item 2 -->
                             <tr class="border-b border-white/5 hover:bg-white/5 transition">
                                <td class="py-4 px-2">
                                    <div class="font-bold text-white">Ahmad Dani</div>
                                    <div class="text-xs text-slate-500">Mahasiswa</div>
                                </td>
                                <td class="py-4 px-2 text-slate-300">Carrier Deuter 65L + Matras</td>
                                <td class="py-4 px-2 text-slate-300">Besok, 09:30 WIB</td>
                                <td class="py-4 px-2">
                                    <div class="flex gap-2">
                                        <button class="bg-brand-500 hover:bg-brand-600 text-dark-950 p-2 rounded-lg transition" title="Setujui">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        </button>
                                        <button class="bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white p-2 rounded-lg transition border border-red-500/20" title="Tolak">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section: Pengembalian Hari Ini -->
            <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-6">
                 <h3 class="font-display font-bold text-lg text-white mb-6">Jadwal Pengembalian Hari Ini</h3>
                 <div class="space-y-4">
                     <!-- Card Item -->
                     <div class="flex items-center justify-between bg-white/5 p-4 rounded-xl border border-white/5 hover:border-brand-500/30 transition">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-white font-bold text-xs">DS</div>
                            <div>
                                <h4 class="font-bold text-white text-sm">Dimas Saputra</h4>
                                <p class="text-xs text-slate-400">Sepatu Hiking Quechua (42)</p>
                            </div>
                        </div>
                        <div class="text-right">
                             <span class="block text-xs font-bold text-orange-500 mb-1">Due: 14:00 WIB</span>
                             <button class="text-[10px] bg-brand-500 text-dark-950 px-2 py-1 rounded font-bold hover:bg-brand-400 transition">Proses Kembali</button>
                        </div>
                     </div>
                     
                     <!-- Card Item -->
                     <div class="flex items-center justify-between bg-white/5 p-4 rounded-xl border border-white/5 hover:border-brand-500/30 transition">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-white font-bold text-xs">IL</div>
                            <div>
                                <h4 class="font-bold text-white text-sm">Indra Lesmana</h4>
                                <p class="text-xs text-slate-400">Headlamp Petzl + Baterai</p>
                            </div>
                        </div>
                        <div class="text-right">
                             <span class="block text-xs font-bold text-red-400 mb-1">Telat 1 Jam</span>
                             <button class="text-[10px] bg-brand-500 text-dark-950 px-2 py-1 rounded font-bold hover:bg-brand-400 transition">Proses & Denda</button>
                        </div>
                     </div>
                 </div>
            </div>

        </div>

        <!-- Right Column: Check & Tools -->
        <div class="space-y-6">
            
            <!-- Quick Tools -->
            <div class="bg-ops-600 rounded-2xl p-6 text-white shadow-lg relative overflow-hidden">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                <h3 class="font-display font-bold text-lg mb-4 relative z-10">Cek Ketersediaan</h3>
                <p class="text-sm text-blue-100 mb-4 relative z-10">Cari stok alat secara cepat untuk menjawab pertanyaan pelanggan.</p>
                <div class="relative z-10">
                    <input type="text" placeholder="Ketik nama alat..." class="w-full bg-white/20 border border-white/30 rounded-lg px-4 py-2 placeholder-white/60 text-white focus:outline-none focus:bg-white/30 mb-2 text-sm">
                    <button class="w-full bg-white text-ops-600 font-bold py-2 rounded-lg text-sm hover:bg-blue-50 transition">Cari Alat</button>
                </div>
            </div>

            <!-- Maintenance Check List -->
            <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-6">
                <h3 class="font-display font-bold text-lg text-white mb-4">Alat Butuh Pengecekan</h3>
                <p class="text-xs text-slate-500 mb-4">Alat di bawah ini dilaporkan bermasalah saat pengembalian terakhir.</p>
                
                <ul class="space-y-3">
                    <li class="flex items-start gap-3 pb-3 border-b border-white/5">
                        <div class="mt-1 w-2 h-2 rounded-full bg-red-500 shrink-0"></div>
                        <div>
                            <p class="text-sm font-bold text-white">Tenda Consina (Code: T-04)</p>
                            <p class="text-xs text-slate-400">Frame patah 1 segmen</p>
                            <a href="#" class="text-[10px] text-blue-400 hover:text-blue-300 mt-1 inline-block">Update Kondisi &rarr;</a>
                        </div>
                    </li>
                    <li class="flex items-start gap-3 pb-3 border-b border-white/5">
                        <div class="mt-1 w-2 h-2 rounded-full bg-orange-500 shrink-0"></div>
                        <div>
                            <p class="text-sm font-bold text-white">Kompor Portable (Code: K-12)</p>
                            <p class="text-xs text-slate-400">Pemantik api macet</p>
                            <a href="#" class="text-[10px] text-blue-400 hover:text-blue-300 mt-1 inline-block">Update Kondisi &rarr;</a>
                        </div>
                    </li>
                </ul>
            </div>
            
        </div>
    </div>
@endsection