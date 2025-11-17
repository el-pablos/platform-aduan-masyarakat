<?php

use App\Models\User;
use App\Models\Laporan;
use App\Models\Tanggapan;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

test('user has required attributes', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'role' => 'warga',
    ]);

    expect($user->name)->toBe('Test User');
    expect($user->email)->toBe('test@example.com');
    expect($user->role)->toBe('warga');
});

test('user has laporans relationship', function () {
    $user = User::factory()->create();
    
    expect($user->laporans())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
});

test('user has tanggapans relationship', function () {
    $user = User::factory()->create();
    
    expect($user->tanggapans())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
});

test('user can have multiple laporans', function () {
    $user = User::factory()->create();
    $laporans = Laporan::factory()->count(3)->create([
        'user_id' => $user->id,
    ]);

    expect($user->laporans)->toHaveCount(3);
    expect($user->laporans->first())->toBeInstanceOf(Laporan::class);
});

test('user can have multiple tanggapans', function () {
    $user = User::factory()->create(['role' => 'petugas']);
    $tanggapans = Tanggapan::factory()->count(3)->create([
        'user_id' => $user->id,
    ]);

    expect($user->tanggapans)->toHaveCount(3);
    expect($user->tanggapans->first())->toBeInstanceOf(Tanggapan::class);
});

test('user role can be warga', function () {
    $user = User::factory()->create(['role' => 'warga']);
    
    expect($user->role)->toBe('warga');
});

test('user role can be petugas', function () {
    $user = User::factory()->create(['role' => 'petugas']);
    
    expect($user->role)->toBe('petugas');
});

test('user role can be admin', function () {
    $user = User::factory()->create(['role' => 'admin']);
    
    expect($user->role)->toBe('admin');
});

test('user password is hashed', function () {
    $user = User::factory()->create(['password' => 'password']);
    
    expect($user->password)->not->toBe('password');
    expect(Hash::check('password', $user->password))->toBeTrue();
});

test('user email is unique', function () {
    User::factory()->create(['email' => 'unique@example.com']);
    
    expect(fn() => User::factory()->create(['email' => 'unique@example.com']))
        ->toThrow(\Illuminate\Database\QueryException::class);
});

test('user uses HasFactory trait', function () {
    $user = User::factory()->create();
    
    expect($user)->toBeInstanceOf(User::class);
});

test('user has timestamps', function () {
    $user = User::factory()->create();
    
    expect($user->created_at)->not->toBeNull();
    expect($user->updated_at)->not->toBeNull();
});

test('deleting user deletes associated laporans', function () {
    $user = User::factory()->create();
    $laporan = Laporan::factory()->create(['user_id' => $user->id]);
    
    $user->delete();
    
    expect(Laporan::find($laporan->id))->toBeNull();
});

test('deleting user deletes associated tanggapans', function () {
    $user = User::factory()->create(['role' => 'petugas']);
    $tanggapan = Tanggapan::factory()->create(['user_id' => $user->id]);
    
    $user->delete();
    
    expect(Tanggapan::find($tanggapan->id))->toBeNull();
});

