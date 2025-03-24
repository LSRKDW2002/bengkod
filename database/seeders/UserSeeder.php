<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Dr.Joni',
            'alamat' => 'Jl.Sadewa',
            'no_hp' => '081234567890',
            'email' => "JoniDr@gmail.com",
            'role' => 'dokter',
            'password' => Hash::make('password')
        ]);

        User::create([
            'nama' => 'Boni',
            'alamat' => 'Jl.Nakula',
            'no_hp' => '081234567891',
            'email' => "Boni@gmail.com",
            'role' => 'pasien',
            'password' => Hash::make('password')
        ]);
    }
}
