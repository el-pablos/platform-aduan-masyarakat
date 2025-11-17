<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
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
