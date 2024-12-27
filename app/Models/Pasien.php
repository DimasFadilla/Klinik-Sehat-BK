<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pasien extends Authenticatable
{
    use HasFactory;

    protected $table = 'pasien';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'alamat',
        'no_ktp',
        'no_hp',
        'no_rm',
    ];

     // Relasi ke Dokter (opsional, jika diperlukan)
     public function dokter()
     {
         return $this->belongsTo(Dokter::class, 'id_dokter');
     }

    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'id_pasien');
    }
}
