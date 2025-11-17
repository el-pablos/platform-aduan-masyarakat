<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relasi ke Laporan
     */
    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    /**
     * Relasi ke User (Petugas yang menanggapi)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
