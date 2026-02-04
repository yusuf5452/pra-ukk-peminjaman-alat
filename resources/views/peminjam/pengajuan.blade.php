@extends('layouts.peminjam')

@section('header', 'Ajukan Peminjaman')

@section('content')
    <div x-data="{ 
        step: 1,
        startDate: '',
        endDate: '',
        duration: 0,
        totalCost: 0,
        showKtpPreview: false,
        items: [
            { id: 1, name: 'Tenda Eiger 4P', price: 50000, qty: 1, img: 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=2070&auto=format&fit=crop' },
            { id: 2, name: 'Matras Foil', price: 10000, qty: 2, img: 'https://images.unsplash.com/photo-1623944889288-cd147dbb517c?q=80&w=2070&auto=format&fit=crop' }
        ],
        
        calculateDuration() {
            if(this.startDate && this.endDate) {
                const start = new Date(this.startDate);
                const end = new Date(this.endDate);
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                this.duration = diffDays > 0 ? diffDays : 1;
                this.calculateTotal();
            }
        },

        calculateTotal() {
            let itemsTotal = this.items.reduce((acc, item) => acc + (item.price * item.qty), 0);
            this.totalCost = itemsTotal * (this.duration || 1);
        },

        previewKtp(event) {
            const file = event.target.files[0];
            if (file) {
                this.showKtpPreview = true;
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.$refs.ktpImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    }" x-init="calculateTotal()">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- LEFT COLUMN: FORM WIZARD -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Progress Indicator -->
                <div class="flex items-center justify-between mb-8 px-2">
                    <div class="flex flex-col items-center relative z-10">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm transition-colors duration-300"
                             :class="step >= 1 ? 'bg-adv-500 text-white' : 'bg-dark-800 text-slate-500 border border-white/10'">1</div>
                        <span class="text-[10px] uppercase font-bold mt-2" :class="step >= 1 ? 'text-adv-500' : 'text-slate-500'">Waktu</span>
                    </div>
                    <div class="flex-1 h-0.5 mx-2 transition-colors duration-300" :class="step >= 2 ? 'bg-adv-500' : 'bg-dark-800'"></div>
                    
                    <div class="flex flex-col items-center relative z-10">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm transition-colors duration-300"
                             :class="step >= 2 ? 'bg-adv-500 text-white' : 'bg-dark-800 text-slate-500 border border-white/10'">2</div>
                        <span class="text-[10px] uppercase font-bold mt-2" :class="step >= 2 ? 'text-adv-500' : 'text-slate-500'">Identitas</span>
                    </div>
                    <div class="flex-1 h-0.5 mx-2 transition-colors duration-300" :class="step >= 3 ? 'bg-adv-500' : 'bg-dark-800'"></div>
                    
                    <div class="flex flex-col items-center relative z-10">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm transition-colors duration-300"
                             :class="step >= 3 ? 'bg-adv-500 text-white' : 'bg-dark-800 text-slate-500 border border-white/10'">3</div>
                        <span class="text-[10px] uppercase font-bold mt-2" :class="step >= 3 ? 'text-adv-500' : 'text-slate-500'">Konfirmasi</span>
                    </div>
                </div>

                <!-- STEP 1: DATE SELECTION -->
                <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-adv-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Rencana Peminjaman
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Tanggal Ambil</label>
                            <input x-model="startDate" @change="calculateDuration" type="date" class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-adv-500 focus:border-adv-500 transition-all shadow-inner">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Tanggal Kembali</label>
                            <input x-model="endDate" @change="calculateDuration" type="date" class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-adv-500 focus:border-adv-500 transition-all shadow-inner">
                        </div>
                    </div>

                    <div class="mt-6 bg-adv-500/10 border border-adv-500/20 rounded-xl p-4 flex items-start gap-3">
                        <svg class="w-5 h-5 text-adv-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <div>
                            <h4 class="text-sm font-bold text-adv-500">Ketentuan Sewa</h4>
                            <ul class="text-xs text-slate-400 mt-1 list-disc list-inside space-y-1">
                                <li>Durasi sewa dihitung per 24 jam.</li>
                                <li>Keterlambatan pengembalian akan dikenakan denda harian.</li>
                                <li>Barang harus diambil pada tanggal mulai sewa.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- STEP 2: IDENTITY UPLOAD -->
                <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" style="display: none;" class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-adv-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .884-.896 1.743-2 1.743S10 6.884 10 6m-4 0h4"/></svg>
                        Verifikasi Identitas
                    </h3>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Upload Foto KTP / Kartu Pelajar</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="ktp-upload" class="flex flex-col items-center justify-center w-full h-48 border-2 border-white/10 border-dashed rounded-2xl cursor-pointer bg-dark-900/50 hover:bg-dark-900 transition-all hover:border-adv-500/50 group relative overflow-hidden">
                                    
                                    <!-- Preview Image -->
                                    <img x-ref="ktpImage" x-show="showKtpPreview" class="absolute inset-0 w-full h-full object-cover opacity-80" />
                                    
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 relative z-10" :class="showKtpPreview ? 'bg-black/60 w-full h-full' : ''">
                                        <svg class="w-10 h-10 mb-3 text-slate-400 group-hover:text-adv-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                        <p class="text-sm text-slate-300 font-medium"><span class="text-adv-500 font-bold">Klik upload</span> atau drag file kesini</p>
                                        <p class="text-xs text-slate-500 mt-1">PNG, JPG atau PDF (Maks. 2MB)</p>
                                    </div>
                                    <input id="ktp-upload" type="file" class="hidden" accept="image/*" @change="previewKtp" />
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Nomor WhatsApp Aktif</label>
                            <input type="tel" placeholder="0812xxxx (Untuk konfirmasi darurat)" class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-adv-500 focus:border-adv-500 transition-all">
                        </div>
                    </div>
                </div>

                <!-- STEP 3: REVIEW & SUBMIT -->
                <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" style="display: none;" class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-adv-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Konfirmasi Akhir
                    </h3>

                    <div class="space-y-4">
                        <div class="bg-dark-900/50 p-4 rounded-xl border border-white/5">
                            <h4 class="text-sm font-bold text-slate-400 mb-2 uppercase tracking-wider">Jadwal</h4>
                            <div class="flex justify-between items-center text-white">
                                <span x-text="startDate"></span>
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                <span x-text="endDate"></span>
                            </div>
                            <p class="text-xs text-adv-500 font-bold mt-2 text-right" x-text="'Durasi: ' + duration + ' Hari'"></p>
                        </div>

                        <div class="bg-dark-900/50 p-4 rounded-xl border border-white/5">
                            <h4 class="text-sm font-bold text-slate-400 mb-2 uppercase tracking-wider">Identitas</h4>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded bg-emerald-500/20 flex items-center justify-center text-emerald-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-white">KTP Terupload</p>
                                    <p class="text-xs text-slate-500">Verifikasi manual oleh petugas</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 mt-4">
                            <input type="checkbox" id="agree" class="mt-1 rounded bg-dark-900 border-white/20 text-adv-500 focus:ring-adv-500">
                            <label for="agree" class="text-xs text-slate-400 leading-relaxed">
                                Saya menyatakan data yang diisi adalah benar dan menyetujui <a href="#" class="text-adv-500 hover:underline">Syarat & Ketentuan</a> peminjaman alat outdoor. Jika terjadi kerusakan/kehilangan, saya bersedia mengganti rugi.
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-8">
                    <button x-show="step > 1" @click="step--" class="px-6 py-3 rounded-xl border border-white/10 text-slate-300 hover:bg-white/5 font-bold transition">
                        Kembali
                    </button>
                    <div class="flex-1"></div> <!-- Spacer -->
                    
                    <button x-show="step < 3" @click="step++" :disabled="!startDate || !endDate" class="px-8 py-3 rounded-xl bg-adv-500 hover:bg-adv-600 text-white font-bold transition shadow-lg shadow-adv-500/20 disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">
                        Lanjut
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>

                    <form x-show="step === 3" action="#" method="POST" style="display: none;"> <!-- Route Submit -->
                        @csrf
                        <button type="submit" class="px-8 py-3 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold transition shadow-lg shadow-emerald-500/20 flex items-center gap-2">
                            Kirim Pengajuan
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </button>
                    </form>
                </div>

            </div>

            <!-- RIGHT COLUMN: ORDER SUMMARY -->
            <div class="lg:col-span-1">
                <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm sticky top-24">
                    <h4 class="text-lg font-bold text-white mb-6 border-b border-white/5 pb-4">Ringkasan Pesanan</h4>
                    
                    <!-- Items List (Cart) -->
                    <div class="space-y-4 mb-6">
                        <template x-for="item in items" :key="item.id">
                            <div class="flex gap-3">
                                <div class="w-12 h-12 rounded-lg bg-dark-900 border border-white/10 overflow-hidden shrink-0">
                                    <img :src="item.img" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <h5 class="text-sm font-bold text-white line-clamp-1" x-text="item.name"></h5>
                                        <button class="text-slate-500 hover:text-red-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                                    </div>
                                    <div class="flex justify-between items-end mt-1">
                                        <p class="text-xs text-slate-400" x-text="item.qty + ' x Rp ' + (item.price/1000) + 'rb'"></p>
                                        <p class="text-sm font-medium text-adv-400" x-text="'Rp ' + (item.price * item.qty).toLocaleString()"></p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Add More Button -->
                    <a href="{{ route('peminjam.alat.index') }}" class="block w-full py-2 border border-dashed border-white/20 hover:border-adv-500 text-slate-400 hover:text-adv-500 text-center rounded-xl text-xs font-bold transition mb-6">
                        + Tambah Alat Lain
                    </a>

                    <!-- Cost Calculation -->
                    <div class="space-y-2 border-t border-white/5 pt-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-400">Durasi Sewa</span>
                            <span class="text-white font-bold" x-text="(duration || 1) + ' Hari'"></span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-400">Subtotal Harian</span>
                            <span class="text-white font-medium">Rp 70.000</span>
                        </div>
                        <div class="flex justify-between items-center pt-2 mt-2 border-t border-white/5">
                            <span class="text-sm font-bold text-white">Total Estimasi</span>
                            <span class="text-xl font-display font-bold text-adv-500" x-text="'Rp ' + totalCost.toLocaleString()"></span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection