<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    protected $fillable = [
        'name',
        'alamat',
        'no_hp',
        'email',
        'role',
        'password',
    ];

    public function pasien(){
        return $this->belongsTo(User::class, 'id_pasien');
    }

    public function dokter(){
        return $this->belongsTo(User::class, 'id_dokter');
    }

    // public function detailPeriksa(){
    //     return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    // }
}
