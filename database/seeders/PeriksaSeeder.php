<?php

namespace Database\Seeders;

use App\Models\Periksa;
use Illuminate\Database\Seeder;

class PeriksaSeeder extends Seeder
{
    public function run(): void
    {
        Periksa::create([
            'id_pasien' => 2, // sesuaikan ID pasien
            'id_dokter' => 1, // sesuaikan ID dokter
            'tgl_periksa' => now(),
            'catatan' => 'Pasien demam dan batuk.',
            'biaya_periksa' => 50000,
        ]);
    }
}
