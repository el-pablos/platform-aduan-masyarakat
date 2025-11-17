<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Kategori;

class LaporanController extends Controller
{
    /**
     * Tampilkan daftar laporan milik user yang login
     */
    public function index()
    {
        $laporans = Laporan::where('user_id', auth()->id())
            ->with('kategori')
            ->latest()
            ->get();

        return view('laporan.index', compact('laporans'));
    }

    /**
     * Tampilkan form buat laporan baru
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('laporan.create', compact('kategoris'));
    }

    /**
     * Simpan laporan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|min:5|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'lokasi' => 'required|string|min:5|max:255',
            'isi_laporan' => 'required|string|min:10',
            'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'menunggu';

        // Handle upload foto
        if ($request->hasFile('foto_bukti')) {
            $path = $request->file('foto_bukti')->store('bukti', 'public');
            $validated['foto_bukti'] = $path;
        }

        Laporan::create($validated);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dibuat!');
    }

    /**
     * Tampilkan detail laporan
     */
    public function show(Laporan $laporan)
    {
        // Pastikan hanya pemilik laporan yang bisa lihat
        if ($laporan->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }

        $laporan->load('kategori', 'tanggapans.user');

        return view('laporan.show', compact('laporan'));
    }

    /**
     * Tampilkan form edit laporan
     */
    public function edit(Laporan $laporan)
    {
        // Pastikan hanya pemilik laporan yang bisa edit
        if ($laporan->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }

        $kategoris = \App\Models\Kategori::all();
        return view('laporan.edit', compact('laporan', 'kategoris'));
    }

    /**
     * Update laporan
     */
    public function update(Request $request, Laporan $laporan)
    {
        // Pastikan hanya pemilik laporan yang bisa update
        if ($laporan->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|min:5|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'lokasi' => 'required|string|min:5|max:255',
            'isi_laporan' => 'required|string|min:10',
            'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['user_id'] = auth()->id();

        // Handle foto bukti jika ada
        if ($request->hasFile('foto_bukti')) {
            // Hapus foto lama jika ada
            if ($laporan->foto_bukti) {
                \Storage::disk('public')->delete($laporan->foto_bukti);
            }
            $validated['foto_bukti'] = $request->file('foto_bukti')->store('laporan', 'public');
        }

        $laporan->update($validated);

        return redirect()->route('laporan.show', $laporan)->with('success', 'Laporan berhasil diperbarui!');
    }

    /**
     * Hapus laporan
     */
    public function destroy(Laporan $laporan)
    {
        // Pastikan hanya pemilik laporan yang bisa hapus
        if ($laporan->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }

        // Hapus foto bukti jika ada
        if ($laporan->foto_bukti) {
            \Storage::disk('public')->delete($laporan->foto_bukti);
        }

        $laporan->delete();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus!');
    }
}
