<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relasi ke Laporan
     */
    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }
}
