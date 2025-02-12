<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPoli extends Model
{
    use HasFactory;

    protected $table = 'daftar_poli';
    public $timestamps = true; // Pastikan timestamps diaktifkan

    protected $fillable = [
        'id_pasien',
        'id_jadwal',
        'keluhan',
        'no_antrian',
    ];

    /**
     * Relasi ke model Pasien
     */
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    /**
     * Relasi ke model Jadwal Periksa
     */
    public function jadwalPeriksa()
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }

    /**
     * Relasi ke model Poli melalui Jadwal Periksa
     */
    public function poli()
    {
        return $this->hasOneThrough(
            Poli::class,
            JadwalPeriksa::class,
            'id',           // Foreign key di tabel Jadwal Periksa
            'id',           // Foreign key di tabel Poli
            'id_jadwal',    // Local key di tabel Daftar Poli
            'id_poli'       // Local key di tabel Jadwal Periksa
        );
    }

    /**
     * Relasi ke tabel Periksa
     */
    public function periksa()
    {
        return $this->hasOne(Periksa::class, 'id_daftar_poli');
    }
}
