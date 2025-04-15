<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periksa;  // Model Periksa
use App\Models\User;     // Model User untuk mengambil data dokter

class PasienPeriksaController extends Controller
{
    // Method untuk menampilkan form pemeriksaan langsung
    public function index()
    {
        // Mendapatkan data dokter untuk dropdown
        $dokters = User::where('role', 'dokter')->get();
        return view('pasien.periksa.index', compact('dokters'));
    }

    // Method untuk menyimpan pemeriksaan
    public function store(Request $request)
{
    // Validasi input dari form
    $request->validate([
        'id_dokter' => 'required',
        'keluhan' => 'required',
    ]);

    // Menyimpan data pemeriksaan ke database
    Periksa::create([
        'id_pasien' => auth()->user()->id,  // Menggunakan id_pasien sesuai dengan kolom di database
        'id_dokter' => $request->id_dokter,
        'keluhan' => $request->keluhan,
        'tgl_periksa' => now(), // Sesuaikan dengan kolom tanggal di tabel Periksa
    ]);

    // Mengarahkan ke halaman riwayat setelah data disimpan
    return redirect()->route('pasien.riwayat')->with('success', 'Pemeriksaan berhasil disimpan');
}
    // Method untuk menampilkan riwayat pemeriksaan
    public function riwayat()
    {
        // Mendapatkan riwayat pemeriksaan pasien berdasarkan id pasien
        $riwayat = Periksa::where('id_pasien', auth()->user()->id)->get();
        return view('pasien.riwayat', compact('riwayat'));
    }

    public function detail($id)
{
    // Menampilkan detail pemeriksaan berdasarkan ID
    $periksa = Periksa::findOrFail($id);
    return view('pasien.detail', compact('periksa'));
}
}
