<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class TanggapanController extends Controller
{
    /**
     * Simpan tanggapan baru dari petugas/admin
     */
    public function store(Request $request, Laporan $laporan)
    {
        $validated = $request->validate([
            'isi_tanggapan' => 'required|string',
        ]);

        $laporan->tanggapans()->create([
            'user_id' => auth()->id(),
            'isi_tanggapan' => $validated['isi_tanggapan'],
        ]);

        return redirect()->back()->with('success', 'Tanggapan berhasil ditambahkan!');
    }
}
