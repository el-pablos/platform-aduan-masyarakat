<?php

use App\Models\User;
use App\Models\Laporan;

test('guest cannot access laporan index', function () {
    $response = $this->get(route('laporan.index'));
    
    $response->assertRedirect(route('login'));
});

test('guest cannot access laporan create', function () {
    $response = $this->get(route('laporan.create'));
    
    $response->assertRedirect(route('login'));
});

test('guest cannot access admin dashboard', function () {
    $response = $this->get(route('admin.dashboard'));
    
    $response->assertRedirect(route('login'));
});

test('warga is redirected to laporan index after login', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    
    $response = $this->post(route('login'), [
        'email' => $warga->email,
        'password' => 'password',
    ]);
    
    $response->assertRedirect(route('laporan.index'));
});

test('admin is redirected to admin dashboard after login', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    
    $response = $this->post(route('login'), [
        'email' => $admin->email,
        'password' => 'password',
    ]);
    
    $response->assertRedirect(route('admin.dashboard'));
});

test('petugas is redirected to admin dashboard after login', function () {
    $petugas = User::factory()->create(['role' => 'petugas']);
    
    $response = $this->post(route('login'), [
        'email' => $petugas->email,
        'password' => 'password',
    ]);
    
    $response->assertRedirect(route('admin.dashboard'));
});

test('admin cannot access warga laporan routes', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    
    $response = $this->actingAs($admin)->get(route('laporan.index'));
    
    $response->assertStatus(403);
});

test('petugas cannot access warga laporan routes', function () {
    $petugas = User::factory()->create(['role' => 'petugas']);
    
    $response = $this->actingAs($petugas)->get(route('laporan.index'));
    
    $response->assertStatus(403);
});

test('warga cannot access admin routes', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    
    $response = $this->actingAs($warga)->get(route('admin.dashboard'));
    
    $response->assertStatus(403);
});

test('admin can only access admin routes', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    
    $this->actingAs($admin)->get(route('admin.dashboard'))->assertStatus(200);
    $this->actingAs($admin)->get(route('laporan.index'))->assertStatus(403);
});

test('petugas can only access admin routes', function () {
    $petugas = User::factory()->create(['role' => 'petugas']);
    
    $this->actingAs($petugas)->get(route('admin.dashboard'))->assertStatus(200);
    $this->actingAs($petugas)->get(route('laporan.index'))->assertStatus(403);
});

test('warga can only access warga routes', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    
    $this->actingAs($warga)->get(route('laporan.index'))->assertStatus(200);
    $this->actingAs($warga)->get(route('admin.dashboard'))->assertStatus(403);
});

test('dashboard_route helper returns correct route for warga', function () {
    $warga = User::factory()->create(['role' => 'warga']);
    
    expect(dashboard_route($warga))->toBe(route('laporan.index'));
});

test('dashboard_route helper returns correct route for admin', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    
    expect(dashboard_route($admin))->toBe(route('admin.dashboard'));
});

test('dashboard_route helper returns correct route for petugas', function () {
    $petugas = User::factory()->create(['role' => 'petugas']);
    
    expect(dashboard_route($petugas))->toBe(route('admin.dashboard'));
});

