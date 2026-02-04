@extends('layouts.admin')

@section('header', 'Pengaturan Profil')

@section('content')
    <div class="max-w-4xl mx-auto space-y-8">

        <!-- 1. Update Profile Information -->
        <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-8 backdrop-blur-sm relative overflow-hidden group hover:border-brand-500/30 transition-all">
            
            <!-- Decor -->
            <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:opacity-10 transition-opacity">
                <svg class="w-32 h-32 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>

            <div class="relative z-10">
                <h3 class="text-xl font-bold text-white mb-1">Informasi Profil</h3>
                <p class="text-sm text-slate-400 mb-6">Perbarui informasi profil akun dan alamat email Anda.</p>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-6 max-w-xl">
                    @csrf
                    @method('patch')

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" 
                                class="w-full bg-dark-900 border border-white/10 rounded-xl pl-10 pr-4 py-2.5 text-white text-sm focus:ring-brand-500 focus:border-brand-500 transition-all">
                        </div>
                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Username / Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <input type="text" name="username" value="{{ old('username', $user->username) }}" required autocomplete="username" 
                                class="w-full bg-dark-900 border border-white/10 rounded-xl pl-10 pr-4 py-2.5 text-white text-sm focus:ring-brand-500 focus:border-brand-500 transition-all">
                        </div>
                        @error('username') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" class="px-6 py-2.5 bg-brand-500 hover:bg-brand-600 text-dark-950 font-bold rounded-xl transition-all shadow-[0_0_20px_rgba(0,220,130,0.3)] hover:shadow-[0_0_30px_rgba(0,220,130,0.5)] text-sm">
                            Simpan Perubahan
                        </button>

                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-brand-500 font-medium">
                                Tersimpan.
                            </p>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- 2. Update Password -->
        <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-8 backdrop-blur-sm relative overflow-hidden group hover:border-blue-500/30 transition-all">
            
            <!-- Decor -->
            <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:opacity-10 transition-opacity">
                <svg class="w-32 h-32 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>

            <div class="relative z-10">
                <h3 class="text-xl font-bold text-white mb-1">Ubah Password</h3>
                <p class="text-sm text-slate-400 mb-6">Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.</p>

                <form method="post" action="{{ route('password.update') }}" class="space-y-6 max-w-xl">
                    @csrf
                    @method('put')

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Password Saat Ini</label>
                        <input type="password" name="current_password" autocomplete="current-password" 
                            class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="••••••••">
                        @error('current_password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Password Baru</label>
                        <input type="password" name="password" autocomplete="new-password" 
                            class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="••••••••">
                        @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" autocomplete="new-password" 
                            class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="••••••••">
                        @error('password_confirmation') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all shadow-[0_0_20px_rgba(37,99,235,0.3)] hover:shadow-[0_0_30px_rgba(37,99,235,0.5)] text-sm">
                            Update Password
                        </button>

                        @if (session('status') === 'password-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-blue-500 font-medium">
                                Password berhasil diubah.
                            </p>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- 3. Notification Settings (Simulasi UI) -->
        <div class="bg-dark-800/50 border border-white/5 rounded-2xl p-8 backdrop-blur-sm">
            <h3 class="text-xl font-bold text-white mb-1">Pengaturan Notifikasi</h3>
            <p class="text-sm text-slate-400 mb-6">Atur bagaimana Anda ingin menerima pemberitahuan sistem.</p>

            <div class="space-y-4 max-w-2xl">
                <div class="flex items-center justify-between p-4 bg-dark-900 rounded-xl border border-white/5">
                    <div>
                        <h4 class="text-sm font-bold text-white">Notifikasi Login</h4>
                        <p class="text-xs text-slate-500">Kirim email saat ada login dari perangkat baru.</p>
                    </div>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input type="checkbox" name="notif_login" id="notif_login" class="toggle-checkbox absolute block w-5 h-5 rounded-full bg-white border-4 appearance-none cursor-pointer checked:right-0 right-5" checked/>
                        <label for="notif_login" class="toggle-label block overflow-hidden h-5 rounded-full bg-brand-500 cursor-pointer"></label>
                    </div>
                </div>

                <div class="flex items-center justify-between p-4 bg-dark-900 rounded-xl border border-white/5">
                    <div>
                        <h4 class="text-sm font-bold text-white">Laporan Mingguan</h4>
                        <p class="text-xs text-slate-500">Terima ringkasan aktivitas sistem setiap hari Senin.</p>
                    </div>
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input type="checkbox" name="notif_report" id="notif_report" class="toggle-checkbox absolute block w-5 h-5 rounded-full bg-white border-4 appearance-none cursor-pointer checked:right-0 right-5"/>
                        <label for="notif_report" class="toggle-label block overflow-hidden h-5 rounded-full bg-slate-700 cursor-pointer"></label>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Toggle Switch Style Helper -->
    <style>
        .toggle-checkbox:checked {
            right: 0;
            border-color: #00dc82;
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: #00dc82;
        }
        .toggle-checkbox {
            right: 0;
            transition: all 0.3s;
        }
        .toggle-label {
            width: 2.5rem;
            height: 1.25rem;
        }
    </style>
@endsection