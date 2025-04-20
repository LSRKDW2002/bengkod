<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    use HasFactory;

    protected $table = 'periksa';
    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'tgl_periksa',
        'keluhan',
        'catatan',
        'biaya_periksa',
    ];

    protected $casts = [
        'tgl_periksa' => 'datetime',
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

    // Accessor untuk status
    public function getStatusAttribute()
    {
        return empty($this->catatan) ? 'Belum Diperiksa' : 'Sudah Diperiksa';
    }

    // Accessor untuk warna status
    public function getStatusColorAttribute()
    {
        return empty($this->catatan) ? 'warning' : 'success';
    }
}