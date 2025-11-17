<?php

use App\Models\User;
use App\Models\Laporan;

test('admin can update laporan status to diproses', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $laporan = Laporan::factory()->create(['status' => 'menunggu']);
    
    $response = $this->actingAs($admin)->patch(route('admin.laporan.updateStatus', $laporan), [
        'status' => 'diproses',
    ]);
    
    $response->assertRedirect();
    $this->assertDatabaseHas('laporans', [
        'id' => $laporan->id,
        'status' => 'diproses',
    ]);
});

test('admin can update laporan status to selesai', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $laporan = Laporan::factory()->create(['status' => 'diproses']);
    
    $response = $this->actingAs($admin)->patch(route('admin.laporan.updateStatus', $laporan), [
        'status' => 'selesai',
    ]);
    
    $response->assertRedirect();
    $this->assertDatabaseHas('laporans', [
        'id' => $laporan->id,
        'status' => 'selesai',
    ]);
});

test('admin can update laporan status to ditolak', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $laporan = Laporan::factory()->create(['status' => 'menunggu']);
    
    $response = $this->actingAs($admin)->patch(route('admin.laporan.updateStatus', $laporan), [
        'status' => 'ditolak',
    ]);
    
    $response->assertRedirect();
    $this->assertDatabaseHas('laporans', [
        'id' => $laporan->id,
        'status' => 'ditolak',
    ]);
});

test('petugas cannot update laporan status', function () {
    $petugas = User::factory()->create(['role' => 'petugas']);
    $laporan = Laporan::factory()->create(['status' => 'menunggu']);
    
    $response = $this->actingAs($petugas)->patch(route('admin.laporan.updateStatus', $laporan), [
        'status' => 'diproses',
    ]);
    
    $response->assertStatus(403);
});

test('warga cannot update laporan status', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $laporan = Laporan::factory()->create(['status' => 'menunggu']);
    
    $response = $this->actingAs($warga)->patch(route('admin.laporan.updateStatus', $laporan), [
        'status' => 'diproses',
    ]);
    
    $response->assertStatus(403);
});

test('status update requires valid status value', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $laporan = Laporan::factory()->create(['status' => 'menunggu']);
    
    $response = $this->actingAs($admin)->patch(route('admin.laporan.updateStatus', $laporan), [
        'status' => 'invalid_status',
    ]);
    
    $response->assertSessionHasErrors('status');
});

test('status update shows success message', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $laporan = Laporan::factory()->create(['status' => 'menunggu']);
    
    $response = $this->actingAs($admin)->patch(route('admin.laporan.updateStatus', $laporan), [
        'status' => 'diproses',
    ]);
    
    $response->assertSessionHas('success');
});

