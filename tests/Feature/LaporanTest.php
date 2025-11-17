<?php

use App\Models\User;
use App\Models\Kategori;
use App\Models\Laporan;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('warga dapat membuat laporan dengan data valid', function () {
    Storage::fake('public');

    $warga = User::factory()->create(['role' => 'warga']);
    $kategori = Kategori::factory()->create();

    $response = $this->actingAs($warga)->post(route('laporan.store'), [
        'judul' => 'Jalan Rusak di Jl. Sudirman',
        'kategori_id' => $kategori->id,
        'lokasi' => 'Jl. Sudirman No. 123',
        'isi_laporan' => 'Jalan berlubang sangat besar',
        'foto_bukti' => UploadedFile::fake()->image('bukti.jpg'),
    ]);

    $response->assertRedirect(route('laporan.index'));
    $this->assertDatabaseHas('laporans', [
        'judul' => 'Jalan Rusak di Jl. Sudirman',
        'user_id' => $warga->id,
        'status' => 'menunggu',
    ]);
});

test('warga dapat melihat daftar laporannya sendiri', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $kategori = Kategori::factory()->create();

    Laporan::factory()->count(3)->create([
        'user_id' => $warga->id,
        'kategori_id' => $kategori->id,
    ]);

    $response = $this->actingAs($warga)->get(route('laporan.index'));

    $response->assertStatus(200);
    $response->assertViewHas('laporans');
});

test('warga hanya dapat melihat detail laporannya sendiri', function () {
    $warga1 = User::factory()->create(['role' => 'warga']);
    $warga2 = User::factory()->create(['role' => 'warga']);
    $kategori = Kategori::factory()->create();

    $laporan = Laporan::factory()->create([
        'user_id' => $warga2->id,
        'kategori_id' => $kategori->id,
    ]);

    $response = $this->actingAs($warga1)->get(route('laporan.show', $laporan));

    $response->assertStatus(403);
});

test('admin dapat melihat semua laporan', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $kategori = Kategori::factory()->create();

    Laporan::factory()->count(5)->create(['kategori_id' => $kategori->id]);

    $response = $this->actingAs($admin)->get(route('admin.dashboard'));

    $response->assertStatus(200);
    $response->assertViewHas('laporans');
});

test('petugas dapat menambahkan tanggapan', function () {
    $petugas = User::factory()->create(['role' => 'petugas']);
    $kategori = Kategori::factory()->create();
    $laporan = Laporan::factory()->create(['kategori_id' => $kategori->id]);

    $response = $this->actingAs($petugas)->post(route('admin.tanggapan.store', $laporan), [
        'isi_tanggapan' => 'Laporan sedang kami proses',
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('tanggapans', [
        'laporan_id' => $laporan->id,
        'user_id' => $petugas->id,
        'isi_tanggapan' => 'Laporan sedang kami proses',
    ]);
});

test('admin dapat mengupdate status laporan', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $kategori = Kategori::factory()->create();
    $laporan = Laporan::factory()->create([
        'kategori_id' => $kategori->id,
        'status' => 'menunggu',
    ]);

    $response = $this->actingAs($admin)->patch(route('admin.laporan.updateStatus', $laporan), [
        'status' => 'diproses',
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('laporans', [
        'id' => $laporan->id,
        'status' => 'diproses',
    ]);
});

test('warga tidak dapat mengakses dashboard admin', function () {
    $warga = User::factory()->create(['role' => 'warga']);

    $response = $this->actingAs($warga)->get(route('admin.dashboard'));

    $response->assertStatus(403);
});

test('guest tidak dapat membuat laporan', function () {
    $kategori = Kategori::factory()->create();

    $response = $this->post(route('laporan.store'), [
        'judul' => 'Test Laporan',
        'kategori_id' => $kategori->id,
        'lokasi' => 'Test Lokasi',
        'isi_laporan' => 'Test Isi',
    ]);

    $response->assertRedirect(route('login'));
});
