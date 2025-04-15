<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Periksa extends Model
{
    use HasFactory;

    protected $table = 'periksa'; // Pastikan nama tabel sesuai
    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'tgl_periksa',
        'keluhan',
        'catatan',
        'biaya_periksa',
    ];

    // Menambahkan casting untuk tgl_periksa
    protected $casts = [
        'tgl_periksa' => 'datetime', // Casting ke tipe data datetime
    ];

    // Relasi ke Pasien
    public function pasien()
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    // Relasi ke Dokter
    public function dokter()
    {
        return $this->belongsTo(User::class, 'id_dokter');
    }

    // Relasi ke DetailPeriksa
    public function detailPeriksa()
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }

    // Relasi ke Obat melalui DetailPeriksa
    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'detail_periksa', 'id_periksa', 'id_obat');
    }
}
