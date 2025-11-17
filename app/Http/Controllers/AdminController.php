<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class AdminController extends Controller
{
    /**
     * Dashboard Admin - Tampilkan semua laporan
     */
    public function dashboard(Request $request)
    {
        $query = Laporan::with('kategori', 'user')->latest();

        // Filter by status jika ada
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $laporans = $query->get();

        return view('admin.dashboard', compact('laporans'));
    }

    /**
     * Tampilkan detail laporan untuk admin/petugas
     */
    public function showLaporan(Laporan $laporan)
    {
        $laporan->load('kategori', 'user', 'tanggapans.user');

        return view('admin.laporan.show', compact('laporan'));
    }

    /**
     * Update status laporan
     */
    public function updateStatus(Request $request, Laporan $laporan)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,ditolak',
        ]);

        $laporan->update($validated);

        return redirect()->back()->with('success', 'Status laporan berhasil diupdate!');
    }
}
