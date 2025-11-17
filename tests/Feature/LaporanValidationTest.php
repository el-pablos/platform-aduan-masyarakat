<?php

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
});

test('laporan judul is required', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $kategori = Kategori::factory()->create();
    
    $response = $this->actingAs($warga)->post(route('laporan.store'), [
        'kategori_id' => $kategori->id,
        'isi_laporan' => 'Test deskripsi',
        'lokasi' => 'Test lokasi',
    ]);
    
    $response->assertSessionHasErrors('judul');
});

test('laporan isi_laporan is required', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $kategori = Kategori::factory()->create();
    
    $response = $this->actingAs($warga)->post(route('laporan.store'), [
        'kategori_id' => $kategori->id,
        'judul' => 'Test Judul',
        'lokasi' => 'Test lokasi',
    ]);
    
    $response->assertSessionHasErrors('isi_laporan');
});

test('laporan lokasi is required', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $kategori = Kategori::factory()->create();
    
    $response = $this->actingAs($warga)->post(route('laporan.store'), [
        'kategori_id' => $kategori->id,
        'judul' => 'Test Judul',
        'isi_laporan' => 'Test deskripsi',
    ]);
    
    $response->assertSessionHasErrors('lokasi');
});

test('laporan kategori_id is required', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    
    $response = $this->actingAs($warga)->post(route('laporan.store'), [
        'judul' => 'Test Judul',
        'isi_laporan' => 'Test deskripsi',
        'lokasi' => 'Test lokasi',
    ]);
    
    $response->assertSessionHasErrors('kategori_id');
});

test('laporan kategori_id must exist in database', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    
    $response = $this->actingAs($warga)->post(route('laporan.store'), [
        'kategori_id' => 999,
        'judul' => 'Test Judul',
        'isi_laporan' => 'Test deskripsi',
        'lokasi' => 'Test lokasi',
    ]);
    
    $response->assertSessionHasErrors('kategori_id');
});

test('laporan foto_bukti must be image', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $kategori = Kategori::factory()->create();
    $file = UploadedFile::fake()->create('document.pdf', 100);
    
    $response = $this->actingAs($warga)->post(route('laporan.store'), [
        'kategori_id' => $kategori->id,
        'judul' => 'Test Judul',
        'isi_laporan' => 'Test deskripsi',
        'lokasi' => 'Test lokasi',
        'foto_bukti' => $file,
    ]);
    
    $response->assertSessionHasErrors('foto_bukti');
});

test('laporan foto_bukti must not exceed 2MB', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $kategori = Kategori::factory()->create();
    $file = UploadedFile::fake()->image('large.jpg')->size(3000);
    
    $response = $this->actingAs($warga)->post(route('laporan.store'), [
        'kategori_id' => $kategori->id,
        'judul' => 'Test Judul',
        'isi_laporan' => 'Test deskripsi',
        'lokasi' => 'Test lokasi',
        'foto_bukti' => $file,
    ]);
    
    $response->assertSessionHasErrors('foto_bukti');
});

test('laporan judul must be at least 5 characters', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $kategori = Kategori::factory()->create();
    
    $response = $this->actingAs($warga)->post(route('laporan.store'), [
        'kategori_id' => $kategori->id,
        'judul' => 'Test',
        'isi_laporan' => 'Test deskripsi',
        'lokasi' => 'Test lokasi',
    ]);
    
    $response->assertSessionHasErrors('judul');
});

test('laporan isi_laporan must be at least 10 characters', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $kategori = Kategori::factory()->create();
    
    $response = $this->actingAs($warga)->post(route('laporan.store'), [
        'kategori_id' => $kategori->id,
        'judul' => 'Test Judul',
        'isi_laporan' => 'Short',
        'lokasi' => 'Test lokasi',
    ]);
    
    $response->assertSessionHasErrors('isi_laporan');
});

test('laporan lokasi must be at least 5 characters', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $kategori = Kategori::factory()->create();
    
    $response = $this->actingAs($warga)->post(route('laporan.store'), [
        'kategori_id' => $kategori->id,
        'judul' => 'Test Judul',
        'isi_laporan' => 'Test deskripsi',
        'lokasi' => 'Jkt',
    ]);
    
    $response->assertSessionHasErrors('lokasi');
});

