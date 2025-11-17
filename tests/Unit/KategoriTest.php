<?php

use App\Models\Kategori;
use App\Models\Laporan;

uses(Tests\TestCase::class);

test('kategori has required attributes', function () {
    $kategori = Kategori::factory()->create([
        'nama' => 'Jalan Rusak',
        'slug' => 'jalan-rusak',
    ]);

    expect($kategori->nama)->toBe('Jalan Rusak');
    expect($kategori->slug)->toBe('jalan-rusak');
});

test('kategori has laporans relationship', function () {
    $kategori = Kategori::factory()->create();
    
    expect($kategori->laporans())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
});

test('kategori can have multiple laporans', function () {
    $kategori = Kategori::factory()->create();
    $laporans = Laporan::factory()->count(3)->create([
        'kategori_id' => $kategori->id,
    ]);

    expect($kategori->laporans)->toHaveCount(3);
    expect($kategori->laporans->first())->toBeInstanceOf(Laporan::class);
});

test('kategori uses HasFactory trait', function () {
    $kategori = Kategori::factory()->create();
    
    expect($kategori)->toBeInstanceOf(Kategori::class);
});

test('kategori nama is required', function () {
    $kategori = new Kategori();
    $kategori->slug = 'test-slug';
    
    expect(fn() => $kategori->save())->toThrow(\Illuminate\Database\QueryException::class);
});

test('kategori slug is required', function () {
    $kategori = new Kategori();
    $kategori->nama = 'Test Kategori';
    
    expect(fn() => $kategori->save())->toThrow(\Illuminate\Database\QueryException::class);
});

test('kategori can be deleted', function () {
    $kategori = Kategori::factory()->create();
    $id = $kategori->id;
    
    $kategori->delete();
    
    expect(Kategori::find($id))->toBeNull();
});

test('deleting kategori deletes associated laporans', function () {
    $kategori = Kategori::factory()->create();
    $laporan = Laporan::factory()->create(['kategori_id' => $kategori->id]);
    
    $kategori->delete();
    
    expect(Laporan::find($laporan->id))->toBeNull();
});

