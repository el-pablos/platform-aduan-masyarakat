<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            ['nama' => 'Jalan Rusak', 'slug' => 'jalan-rusak'],
            ['nama' => 'Sampah', 'slug' => 'sampah'],
            ['nama' => 'Penerangan Jalan', 'slug' => 'penerangan-jalan'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}
