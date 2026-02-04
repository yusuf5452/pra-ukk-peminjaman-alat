<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class AdminAlatController extends Controller
{
    public function index(Request $request)
    {
        // Query data alat beserta relasi kategorinya
        $query = Alat::with('kategori');

        // Logika Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_alat', 'like', "%{$search}%")
                  ->orWhereHas('kategori', function($q) use ($search) {
                      $q->where('nama_kategori', 'like', "%{$search}%");
                  });
        }

        // Ambil data terbaru
        $alat = $query->latest()->get();
        $kategori = Kategori::all(); // Untuk dropdown di modal
        
        // Statistik untuk kartu di atas
        $totalAlat = Alat::count();
        $totalStok = Alat::sum('stok');

        return view('admin.alat', compact('alat', 'kategori', 'totalAlat', 'totalStok'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'stok' => 'required|integer|min:0',
            'harga_sewa' => 'required|numeric|min:0',
            'harga_denda' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'deskripsi' => 'nullable|string'
        ]);

        $data = [
            'nama_alat' => $request->nama,
            'id_kategori' => $request->kategori_id,
            'stok' => $request->stok,
            'harga_sewa_per_hari' => $request->harga_sewa,
            'harga_denda_per_hari' => $request->harga_denda,
            'deskripsi' => $request->deskripsi,
            'kondisi' => 'Baik', // Default kondisi awal
        ];

        // Proses Upload Gambar
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('alat', 'public');
            $data['gambar'] = $path;
        }

        Alat::create($data);

        return redirect()->route('admin.alat.index')->with('success', 'Alat berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'stok' => 'required|integer|min:0',
            'harga_sewa' => 'required|numeric|min:0',
            'harga_denda' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'deskripsi' => 'nullable|string'
        ]);

        $data = [
            'nama_alat' => $request->nama,
            'id_kategori' => $request->kategori_id,
            'stok' => $request->stok,
            'harga_sewa_per_hari' => $request->harga_sewa,
            'harga_denda_per_hari' => $request->harga_denda,
            'deskripsi' => $request->deskripsi,
        ];

        // Proses Update Gambar (Hapus lama jika ada yang baru)
        if ($request->hasFile('foto')) {
            if ($alat->gambar && Storage::disk('public')->exists($alat->gambar)) {
                Storage::disk('public')->delete($alat->gambar);
            }
            $path = $request->file('foto')->store('alat', 'public');
            $data['gambar'] = $path;
        }

        $alat->update($data);

        return redirect()->route('admin.alat.index')->with('success', 'Data alat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);

        // Hapus file gambar fisik jika ada
        if ($alat->gambar && Storage::disk('public')->exists($alat->gambar)) {
            Storage::disk('public')->delete($alat->gambar);
        }

        $alat->delete();

        return redirect()->route('admin.alat.index')->with('success', 'Alat berhasil dihapus!');
    }
}