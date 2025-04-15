<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\Obat;
use App\Models\DetailPeriksa;
use Illuminate\Http\Request;

class PeriksaController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:dokter'); // Biar cuma dokter yang bisa akses
    }

    public function index()
    {
        $periksas = Periksa::where('id_dokter', auth()->id())
            ->with('pasien', 'obats')
            ->get();

        return view('dokter.periksa.index', compact('periksas'));
    }

    public function edit($id)
    {
        $periksa = Periksa::with('pasien', 'obats')->findOrFail($id);
        $obats = Obat::all();

        return view('dokter.periksa.edit', compact('periksa', 'obats'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'catatan' => 'required|string',
        'biaya_periksa' => 'required|numeric',
        'obat' => 'array',
    ]);

    $periksa = Periksa::findOrFail($id);
    
    // Update catatan dan biaya pemeriksaan
    $periksa->update([
        'catatan' => $request->catatan,
        'biaya_periksa' => $request->biaya_periksa,  // Pastikan biaya pemeriksaan disimpan
    ]);

    // Update obat yang dipilih
    DetailPeriksa::where('id_periksa', $periksa->id)->delete();

    if ($request->has('obat')) {
        foreach ($request->obat as $idObat) {
            DetailPeriksa::create([
                'id_periksa' => $periksa->id,
                'id_obat' => $idObat,
            ]);
        }
    }

    return redirect()->route('dokter.periksa.index')->with('success', 'Data diperbarui.');
}

}
