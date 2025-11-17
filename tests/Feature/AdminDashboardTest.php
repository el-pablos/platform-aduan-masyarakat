<?php

use App\Models\User;
use App\Models\Laporan;

test('admin can access admin dashboard', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    
    $response = $this->actingAs($admin)->get(route('admin.dashboard'));
    
    $response->assertStatus(200);
    $response->assertViewIs('admin.dashboard');
});

test('petugas can access admin dashboard', function () {
    $petugas = User::factory()->create(['role' => 'petugas']);
    
    $response = $this->actingAs($petugas)->get(route('admin.dashboard'));
    
    $response->assertStatus(200);
    $response->assertViewIs('admin.dashboard');
});

test('warga cannot access admin dashboard', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    
    $response = $this->actingAs($warga)->get(route('admin.dashboard'));
    
    $response->assertStatus(403);
});

test('admin dashboard shows all laporans', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $laporans = Laporan::factory()->count(5)->create();
    
    $response = $this->actingAs($admin)->get(route('admin.dashboard'));
    
    $response->assertViewHas('laporans', function ($viewLaporans) use ($laporans) {
        return $viewLaporans->count() === 5;
    });
});

test('admin can filter laporans by status menunggu', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    Laporan::factory()->count(3)->create(['status' => 'menunggu']);
    Laporan::factory()->count(2)->create(['status' => 'diproses']);
    
    $response = $this->actingAs($admin)->get(route('admin.dashboard', ['status' => 'menunggu']));
    
    $response->assertViewHas('laporans', function ($laporans) {
        return $laporans->count() === 3 && $laporans->every(fn($l) => $l->status === 'menunggu');
    });
});

test('admin can filter laporans by status diproses', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    Laporan::factory()->count(3)->create(['status' => 'menunggu']);
    Laporan::factory()->count(2)->create(['status' => 'diproses']);
    
    $response = $this->actingAs($admin)->get(route('admin.dashboard', ['status' => 'diproses']));
    
    $response->assertViewHas('laporans', function ($laporans) {
        return $laporans->count() === 2 && $laporans->every(fn($l) => $l->status === 'diproses');
    });
});

test('admin can filter laporans by status selesai', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    Laporan::factory()->count(3)->create(['status' => 'selesai']);
    Laporan::factory()->count(2)->create(['status' => 'diproses']);
    
    $response = $this->actingAs($admin)->get(route('admin.dashboard', ['status' => 'selesai']));
    
    $response->assertViewHas('laporans', function ($laporans) {
        return $laporans->count() === 3 && $laporans->every(fn($l) => $l->status === 'selesai');
    });
});

test('admin can filter laporans by status ditolak', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    Laporan::factory()->count(1)->create(['status' => 'ditolak']);
    Laporan::factory()->count(2)->create(['status' => 'diproses']);
    
    $response = $this->actingAs($admin)->get(route('admin.dashboard', ['status' => 'ditolak']));
    
    $response->assertViewHas('laporans', function ($laporans) {
        return $laporans->count() === 1 && $laporans->every(fn($l) => $l->status === 'ditolak');
    });
});

test('admin can view laporan detail', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $laporan = Laporan::factory()->create();
    
    $response = $this->actingAs($admin)->get(route('admin.laporan.show', $laporan));
    
    $response->assertStatus(200);
    $response->assertViewIs('admin.laporan.show');
    $response->assertViewHas('laporan', $laporan);
});

test('petugas can view laporan detail', function () {
    $petugas = User::factory()->create(['role' => 'petugas']);
    $laporan = Laporan::factory()->create();
    
    $response = $this->actingAs($petugas)->get(route('admin.laporan.show', $laporan));
    
    $response->assertStatus(200);
    $response->assertViewIs('admin.laporan.show');
});

test('warga cannot view admin laporan detail', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    $laporan = Laporan::factory()->create();
    
    $response = $this->actingAs($warga)->get(route('admin.laporan.show', $laporan));
    
    $response->assertStatus(403);
});

