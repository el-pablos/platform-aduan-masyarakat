<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\Kategori;
use App\Models\Laporan;

$warga = User::where('role', 'warga')->first();
$kategoris = Kategori::all();

$laporanData = [
    [
        'judul' => 'Jalan Berlubang di Jl. Sudirman',
        'isi_laporan' => 'Jalan berlubang cukup besar dan berbahaya untuk pengendara motor. Lubang berdiameter sekitar 50cm dan kedalaman 20cm. Mohon segera diperbaiki.',
        'lokasi' => 'Jl. Sudirman No. 123',
        'kategori_id' => $kategoris->where('slug', 'jalan-rusak')->first()->id,
    ],
    [
        'judul' => 'Tumpukan Sampah di Pasar',
        'isi_laporan' => 'Sampah menumpuk dan menimbulkan bau tidak sedap. Sudah 3 hari tidak diangkut oleh petugas kebersihan.',
        'lokasi' => 'Pasar Sentral Blok A',
        'kategori_id' => $kategoris->where('slug', 'sampah')->first()->id,
    ],
    [
        'judul' => 'Lampu Jalan Mati',
        'isi_laporan' => 'Lampu jalan sudah mati sejak 3 hari yang lalu. Menyebabkan jalan gelap dan rawan kejahatan di malam hari.',
        'lokasi' => 'Jl. Merdeka Raya',
        'kategori_id' => $kategoris->where('slug', 'penerangan-jalan')->first()->id,
    ],
    [
        'judul' => 'Jalan Retak di Perumahan',
        'isi_laporan' => 'Jalan aspal mulai retak dan perlu perbaikan. Retakan semakin melebar dan berbahaya untuk kendaraan.',
        'lokasi' => 'Perumahan Griya Asri Blok C',
        'kategori_id' => $kategoris->where('slug', 'jalan-rusak')->first()->id,
    ],
    [
        'judul' => 'Sampah Berserakan di Taman',
        'isi_laporan' => 'Banyak sampah berserakan di taman kota. Tempat sampah penuh dan tidak ada petugas yang membersihkan.',
        'lokasi' => 'Taman Kota Sejahtera',
        'kategori_id' => $kategoris->where('slug', 'sampah')->first()->id,
    ],
];

foreach ($laporanData as $data) {
    Laporan::create([
        'user_id' => $warga->id,
        'kategori_id' => $data['kategori_id'],
        'judul' => $data['judul'],
        'isi_laporan' => $data['isi_laporan'],
        'lokasi' => $data['lokasi'],
        'status' => 'menunggu',
    ]);
}

echo "5 laporan dummy berhasil dibuat!\n";

