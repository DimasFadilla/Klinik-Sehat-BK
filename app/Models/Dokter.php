<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'id_poli',
    ];

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }
    public function pasiens()
    {
    return $this->hasMany(Pasien::class, 'id_dokter'); // Pastikan kolom 'id_dokter' sesuai
    }
      // Relasi Dokter ke JadwalPeriksa (One to Many)
      public function jadwalPeriksa()
      {
          return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
      }
      public function daftarPoli()
    {
    return $this->hasManyThrough(
        DaftarPoli::class,
        JadwalPeriksa::class,
        'id_dokter', // Foreign key di tabel Jadwal Periksa
        'id_jadwal', // Foreign key di tabel Daftar Poli
        'id',        // Primary key di tabel Dokter
        'id'         // Primary key di tabel Jadwal Periksa
    );
    }

  
      // Relasi Dokter ke Pasien (jika diperlukan)
    
}
