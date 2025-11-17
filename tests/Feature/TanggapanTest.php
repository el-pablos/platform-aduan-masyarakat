<?php

use App\Models\User;
use App\Models\Laporan;
use App\Models\Tanggapan;

test('admin can create tanggapan', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $laporan = Laporan::factory()->create();
    
    $response = $this->actingAs($admin)->post(route('admin.tanggapan.store', $laporan), [
        'isi_tanggapan' => 'Tanggapan dari admin',
    ]);
    
    $response->assertRedirect();
    $this->assertDatabaseHas('tanggapans', [
        'laporan_id' => $laporan->id,
        'user_id' => $admin->id,
        'isi_tanggapan' => 'Tanggapan dari admin',
    ]);
});

test('petugas can create tanggapan', function () {
    $petugas = User::factory()->create(['role' => 'petugas']);
    $laporan = Laporan::factory()->create();
    
    $response = $this->actingAs($petugas)->post(route('admin.tanggapan.store', $laporan), [
        'isi_tanggapan' => 'Tanggapan dari petugas',
    ]);
    
    $response->assertRedirect();
    $this->assertDatabaseHas('tanggapans', [
        'laporan_id' => $laporan->id,
        'user_id' => $petugas->id,
        'isi_tanggapan' => 'Tanggapan dari petugas',
    ]);
});

test('warga cannot create tanggapan', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $laporan = Laporan::factory()->create();
    
    $response = $this->actingAs($warga)->post(route('admin.tanggapan.store', $laporan), [
        'isi_tanggapan' => 'Tanggapan dari warga',
    ]);
    
    $response->assertStatus(403);
});

test('tanggapan isi_tanggapan is required', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $laporan = Laporan::factory()->create();
    
    $response = $this->actingAs($admin)->post(route('admin.tanggapan.store', $laporan), [
        'isi_tanggapan' => '',
    ]);
    
    $response->assertSessionHasErrors('isi_tanggapan');
});

test('tanggapan isi_tanggapan must be at least 10 characters', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $laporan = Laporan::factory()->create();
    
    $response = $this->actingAs($admin)->post(route('admin.tanggapan.store', $laporan), [
        'isi_tanggapan' => 'Short',
    ]);
    
    $response->assertSessionHasErrors('isi_tanggapan');
});

test('creating tanggapan shows success message', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $laporan = Laporan::factory()->create();
    
    $response = $this->actingAs($admin)->post(route('admin.tanggapan.store', $laporan), [
        'isi_tanggapan' => 'Tanggapan dari admin',
    ]);
    
    $response->assertSessionHas('success');
});

test('laporan can have multiple tanggapans from different users', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $petugas = User::factory()->create(['role' => 'petugas']);
    $laporan = Laporan::factory()->create();
    
    $this->actingAs($admin)->post(route('admin.tanggapan.store', $laporan), [
        'isi_tanggapan' => 'Tanggapan dari admin',
    ]);
    
    $this->actingAs($petugas)->post(route('admin.tanggapan.store', $laporan), [
        'isi_tanggapan' => 'Tanggapan dari petugas',
    ]);
    
    expect($laporan->fresh()->tanggapans)->toHaveCount(2);
});

test('warga can see tanggapans on their laporan', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $admin = User::factory()->create(['role' => 'admin']);
    $laporan = Laporan::factory()->create(['user_id' => $warga->id]);
    
    Tanggapan::factory()->create([
        'laporan_id' => $laporan->id,
        'user_id' => $admin->id,
        'isi_tanggapan' => 'Tanggapan dari admin',
    ]);
    
    $response = $this->actingAs($warga)->get(route('laporan.show', $laporan));
    
    $response->assertSee('Tanggapan dari admin');
});

