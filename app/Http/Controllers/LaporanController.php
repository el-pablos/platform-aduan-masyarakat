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
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'lokasi' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
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
}
