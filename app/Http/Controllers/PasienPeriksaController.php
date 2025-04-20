<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periksa;
use App\Models\User;

class PasienPeriksaController extends Controller
{
    public function index()
    {
        $dokters = User::where('role', 'dokter')->get();
        return view('pasien.periksa.index', compact('dokters'));
    }

    public function store(Request $request)
{
    $request->validate([
        'id_dokter' => 'required|exists:users,id',
        'keluhan' => 'required|string|max:1000',
    ]);

    Periksa::create([
        'id_pasien' => auth()->id(),
        'id_dokter' => $request->id_dokter,
        'keluhan' => $request->keluhan,
        'tgl_periksa' => now(),
        'catatan' => null, // Tambahkan default value untuk kolom yang diperlukan
        'biaya_periksa' => 0 // Default biaya 0
    ]);

    return redirect()->route('pasien.riwayat')
        ->with('success', 'Pemeriksaan berhasil diajukan');
}

    public function riwayat()
    {
        $riwayat = Periksa::where('id_pasien', auth()->id())
            ->with(['dokter', 'obats'])
            ->orderBy('tgl_periksa', 'desc')
            ->get();

        return view('pasien.riwayat', compact('riwayat'));
    }

    public function detail($id)
    {
        $periksa = Periksa::with(['dokter', 'obats'])
            ->where('id_pasien', auth()->id())
            ->findOrFail($id);

        return view('pasien.detail', compact('periksa'));
    }

    public function dashboard()
{
    // Ambil semua riwayat pemeriksaan pasien
    $riwayat = Periksa::where('id_pasien', auth()->id())
        ->with(['dokter', 'obats'])
        ->orderBy('tgl_periksa', 'desc')
        ->get();

    // Tambahkan status_color ke setiap pemeriksaan
    $riwayat->each(function ($item) {
        $item->status_color = $this->getStatusColor($item->status);
    });

    // Filter untuk 24 jam terakhir
    $riwayat24Jam = $riwayat->filter(function($item) {
        return $item->tgl_periksa >= now()->subDay();
    });

    // Ambil 5 aktivitas terbaru
    $aktivitasTerkini = $riwayat->take(5);

    return view('pasien.dashboard', compact('riwayat', 'riwayat24Jam', 'aktivitasTerkini'));
}

private function getStatusColor($status)
{
    $status = strtolower($status);
    $colors = [
        'selesai' => 'success',
        'proses' => 'warning',
        'menunggu' => 'info',
        'dibatalkan' => 'danger',
        'belum diperiksa' => 'secondary'
    ];

    return $colors[$status] ?? 'secondary';
}
}