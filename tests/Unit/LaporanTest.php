<?php

use App\Models\Laporan;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Tanggapan;

uses(Tests\TestCase::class);

test('laporan has required attributes', function () {
    $user = User::factory()->create();
    $kategori = Kategori::factory()->create();
    
    $laporan = Laporan::factory()->create([
        'user_id' => $user->id,
        'kategori_id' => $kategori->id,
        'judul' => 'Test Laporan',
        'isi_laporan' => 'Deskripsi laporan test',
        'lokasi' => 'Jakarta',
        'status' => 'menunggu',
    ]);

    expect($laporan->judul)->toBe('Test Laporan');
    expect($laporan->isi_laporan)->toBe('Deskripsi laporan test');
    expect($laporan->lokasi)->toBe('Jakarta');
    expect($laporan->status)->toBe('menunggu');
});

test('laporan belongs to user', function () {
    $laporan = Laporan::factory()->create();
    
    expect($laporan->user())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
    expect($laporan->user)->toBeInstanceOf(User::class);
});

test('laporan belongs to kategori', function () {
    $laporan = Laporan::factory()->create();
    
    expect($laporan->kategori())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
    expect($laporan->kategori)->toBeInstanceOf(Kategori::class);
});

test('laporan has tanggapans relationship', function () {
    $laporan = Laporan::factory()->create();
    
    expect($laporan->tanggapans())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
});

test('laporan can have multiple tanggapans', function () {
    $laporan = Laporan::factory()->create();
    $tanggapans = Tanggapan::factory()->count(3)->create([
        'laporan_id' => $laporan->id,
    ]);

    expect($laporan->tanggapans)->toHaveCount(3);
    expect($laporan->tanggapans->first())->toBeInstanceOf(Tanggapan::class);
});

test('laporan status can be menunggu', function () {
    $laporan = Laporan::factory()->create(['status' => 'menunggu']);
    
    expect($laporan->status)->toBe('menunggu');
});

test('laporan status can be diproses', function () {
    $laporan = Laporan::factory()->create(['status' => 'diproses']);
    
    expect($laporan->status)->toBe('diproses');
});

test('laporan status can be selesai', function () {
    $laporan = Laporan::factory()->create(['status' => 'selesai']);
    
    expect($laporan->status)->toBe('selesai');
});

test('laporan status can be ditolak', function () {
    $laporan = Laporan::factory()->create(['status' => 'ditolak']);
    
    expect($laporan->status)->toBe('ditolak');
});

test('laporan foto_bukti is nullable', function () {
    $laporan = Laporan::factory()->create(['foto_bukti' => null]);
    
    expect($laporan->foto_bukti)->toBeNull();
});

test('laporan can have foto_bukti', function () {
    $laporan = Laporan::factory()->create(['foto_bukti' => 'laporans/test.jpg']);
    
    expect($laporan->foto_bukti)->toBe('laporans/test.jpg');
});

test('laporan uses HasFactory trait', function () {
    $laporan = Laporan::factory()->create();
    
    expect($laporan)->toBeInstanceOf(Laporan::class);
});

test('deleting laporan deletes associated tanggapans', function () {
    $laporan = Laporan::factory()->create();
    $tanggapan = Tanggapan::factory()->create(['laporan_id' => $laporan->id]);
    
    $laporan->delete();
    
    expect(Tanggapan::find($tanggapan->id))->toBeNull();
});

test('laporan has timestamps', function () {
    $laporan = Laporan::factory()->create();
    
    expect($laporan->created_at)->not->toBeNull();
    expect($laporan->updated_at)->not->toBeNull();
});

