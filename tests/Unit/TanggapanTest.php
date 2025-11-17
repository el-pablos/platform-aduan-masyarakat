<?php

use App\Models\Tanggapan;
use App\Models\Laporan;
use App\Models\User;

uses(Tests\TestCase::class);

test('tanggapan has required attributes', function () {
    $laporan = Laporan::factory()->create();
    $user = User::factory()->create(['role' => 'petugas']);
    
    $tanggapan = Tanggapan::factory()->create([
        'laporan_id' => $laporan->id,
        'user_id' => $user->id,
        'isi_tanggapan' => 'Tanggapan test',
    ]);

    expect($tanggapan->isi_tanggapan)->toBe('Tanggapan test');
    expect($tanggapan->laporan_id)->toBe($laporan->id);
    expect($tanggapan->user_id)->toBe($user->id);
});

test('tanggapan belongs to laporan', function () {
    $tanggapan = Tanggapan::factory()->create();
    
    expect($tanggapan->laporan())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
    expect($tanggapan->laporan)->toBeInstanceOf(Laporan::class);
});

test('tanggapan belongs to user', function () {
    $tanggapan = Tanggapan::factory()->create();
    
    expect($tanggapan->user())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
    expect($tanggapan->user)->toBeInstanceOf(User::class);
});

test('tanggapan has timestamps', function () {
    $tanggapan = Tanggapan::factory()->create();
    
    expect($tanggapan->created_at)->not->toBeNull();
    expect($tanggapan->updated_at)->not->toBeNull();
});

test('tanggapan can be created by petugas', function () {
    $petugas = User::factory()->create(['role' => 'petugas']);
    $laporan = Laporan::factory()->create();
    
    $tanggapan = Tanggapan::factory()->create([
        'user_id' => $petugas->id,
        'laporan_id' => $laporan->id,
    ]);
    
    expect($tanggapan->user->role)->toBe('petugas');
});

test('tanggapan can be created by admin', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $laporan = Laporan::factory()->create();
    
    $tanggapan = Tanggapan::factory()->create([
        'user_id' => $admin->id,
        'laporan_id' => $laporan->id,
    ]);
    
    expect($tanggapan->user->role)->toBe('admin');
});

test('tanggapan can be deleted', function () {
    $tanggapan = Tanggapan::factory()->create();
    $id = $tanggapan->id;
    
    $tanggapan->delete();
    
    expect(Tanggapan::find($id))->toBeNull();
});

