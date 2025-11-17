<?php

use App\Models\User;
use App\Models\Laporan;
use App\Models\Kategori;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
});

test('warga can view laporan index page', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    
    $response = $this->actingAs($warga)->get(route('laporan.index'));
    
    $response->assertStatus(200);
    $response->assertViewIs('laporan.index');
});

test('warga can view create laporan page', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    
    $response = $this->actingAs($warga)->get(route('laporan.create'));
    
    $response->assertStatus(200);
    $response->assertViewIs('laporan.create');
});

test('warga can create laporan without foto', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $kategori = Kategori::factory()->create();
    
    $response = $this->actingAs($warga)->post(route('laporan.store'), [
        'kategori_id' => $kategori->id,
        'judul' => 'Jalan Berlubang',
        'isi_laporan' => 'Jalan di depan rumah saya berlubang',
        'lokasi' => 'Jl. Merdeka No. 123',
    ]);
    
    $response->assertRedirect(route('laporan.index'));
    $response->assertSessionHas('success');
    
    $this->assertDatabaseHas('laporans', [
        'judul' => 'Jalan Berlubang',
        'user_id' => $warga->id,
    ]);
});

test('warga can create laporan with foto', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $kategori = Kategori::factory()->create();
    $file = UploadedFile::fake()->image('bukti.jpg');
    
    $response = $this->actingAs($warga)->post(route('laporan.store'), [
        'kategori_id' => $kategori->id,
        'judul' => 'Jalan Berlubang',
        'isi_laporan' => 'Jalan di depan rumah saya berlubang',
        'lokasi' => 'Jl. Merdeka No. 123',
        'foto_bukti' => $file,
    ]);
    
    $response->assertRedirect(route('laporan.index'));
    
    $laporan = Laporan::where('judul', 'Jalan Berlubang')->first();
    expect($laporan->foto_bukti)->not->toBeNull();
    Storage::disk('public')->assertExists($laporan->foto_bukti);
});

test('warga can view their own laporan', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $laporan = Laporan::factory()->create(['user_id' => $warga->id]);
    
    $response = $this->actingAs($warga)->get(route('laporan.show', $laporan));
    
    $response->assertStatus(200);
    $response->assertViewIs('laporan.show');
    $response->assertViewHas('laporan', $laporan);
});

test('warga cannot view other users laporan', function () {
    $warga1 = User::factory()->create(['role' => 'warga']);
    $warga2 = User::factory()->create(['role' => 'warga']);
    $laporan = Laporan::factory()->create(['user_id' => $warga2->id]);
    
    $response = $this->actingAs($warga1)->get(route('laporan.show', $laporan));
    
    $response->assertStatus(403);
});

test('warga can view edit page for their own laporan', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $laporan = Laporan::factory()->create(['user_id' => $warga->id]);
    
    $response = $this->actingAs($warga)->get(route('laporan.edit', $laporan));
    
    $response->assertStatus(200);
    $response->assertViewIs('laporan.edit');
});

test('warga can update their own laporan', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $laporan = Laporan::factory()->create(['user_id' => $warga->id]);
    $kategori = Kategori::factory()->create();
    
    $response = $this->actingAs($warga)->put(route('laporan.update', $laporan), [
        'kategori_id' => $kategori->id,
        'judul' => 'Updated Judul',
        'isi_laporan' => 'Updated deskripsi',
        'lokasi' => 'Updated lokasi',
    ]);

    $response->assertRedirect(route('laporan.show', $laporan));
    
    $this->assertDatabaseHas('laporans', [
        'id' => $laporan->id,
        'judul' => 'Updated Judul',
    ]);
});

test('warga cannot update other users laporan', function () {
    $warga1 = User::factory()->create(['role' => 'warga']);
    $warga2 = User::factory()->create(['role' => 'warga']);
    $laporan = Laporan::factory()->create(['user_id' => $warga2->id]);
    $kategori = Kategori::factory()->create();
    
    $response = $this->actingAs($warga1)->put(route('laporan.update', $laporan), [
        'kategori_id' => $kategori->id,
        'judul' => 'Hacked',
        'isi_laporan' => 'Hacked',
        'lokasi' => 'Hacked',
    ]);
    
    $response->assertStatus(403);
});

test('warga can delete their own laporan', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $laporan = Laporan::factory()->create(['user_id' => $warga->id]);
    
    $response = $this->actingAs($warga)->delete(route('laporan.destroy', $laporan));
    
    $response->assertRedirect(route('laporan.index'));
    $this->assertDatabaseMissing('laporans', ['id' => $laporan->id]);
});

test('warga cannot delete other users laporan', function () {
    $warga1 = User::factory()->create(['role' => 'warga']);
    $warga2 = User::factory()->create(['role' => 'warga']);
    $laporan = Laporan::factory()->create(['user_id' => $warga2->id]);
    
    $response = $this->actingAs($warga1)->delete(route('laporan.destroy', $laporan));
    
    $response->assertStatus(403);
    $this->assertDatabaseHas('laporans', ['id' => $laporan->id]);
});

