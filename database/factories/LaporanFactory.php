<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Kategori;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laporan>
 */
class LaporanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'kategori_id' => Kategori::firstOrCreate(
                ['slug' => 'infrastruktur'],
                ['nama' => 'Infrastruktur']
            )->id,
            'judul' => fake()->sentence(),
            'isi_laporan' => fake()->paragraph(),
            'lokasi' => fake()->address(),
            'foto_bukti' => null,
            'status' => fake()->randomElement(['menunggu', 'diproses', 'selesai', 'ditolak']),
        ];
    }
}
