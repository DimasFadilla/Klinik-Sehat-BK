<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPoli extends Model
{
    protected $table = 'daftar_poli';
    public $timestamps = false;

    protected $fillable = [
        'id_pasien',
        'id_jadwal',
        'keluhan',
        'no_antrian',
    ];

    public function dokter()
    {
        return $this->hasMany(Dokter::class, 'id_poli');
    }
    
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function jadwalPeriksa()
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }

}
