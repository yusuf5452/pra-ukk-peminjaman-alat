<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Selamat Datang, Administrator!</h3>
                    <p>Ini adalah halaman khusus untuk role Admin.</p>
                    
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Contoh Card Menu -->
                        <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-200">
                            <h4 class="font-bold text-indigo-700">Kelola Alat</h4>
                            <p class="text-sm mt-1">Tambah, edit, dan hapus data alat outdoor.</p>
                        </div>
                        
                        <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                            <h4 class="font-bold text-green-700">Verifikasi Peminjaman</h4>
                            <p class="text-sm mt-1">Cek pengajuan peminjaman masuk.</p>
                        </div>

                        <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                            <h4 class="font-bold text-yellow-700">Laporan</h4>
                            <p class="text-sm mt-1">Lihat riwayat dan denda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>