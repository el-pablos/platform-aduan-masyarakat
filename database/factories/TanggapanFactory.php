<?php

namespace Database\Factories;

use App\Models\Tanggapan;
use App\Models\User;
use App\Models\Laporan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tanggapan>
 */
class TanggapanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tanggapan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'laporan_id' => Laporan::factory(),
            'user_id' => User::factory()->create(['role' => 'petugas']),
            'isi_tanggapan' => fake()->paragraph(3),
        ];
    }

    /**
     * Indicate that the tanggapan is from admin.
     */
    public function fromAdmin(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => User::factory()->create(['role' => 'admin']),
        ]);
    }

    /**
     * Indicate that the tanggapan is from petugas.
     */
    public function fromPetugas(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => User::factory()->create(['role' => 'petugas']),
        ]);
    }

    /**
     * Indicate that the tanggapan is for a specific laporan.
     */
    public function forLaporan(Laporan $laporan): static
    {
        return $this->state(fn (array $attributes) => [
            'laporan_id' => $laporan->id,
        ]);
    }
}

