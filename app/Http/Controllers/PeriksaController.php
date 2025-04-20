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
        $this->middleware('role:dokter');
    }

    public function index()
    {
        $periksas = Periksa::where('id_dokter', auth()->id())
            ->with(['pasien', 'obats'])
            ->orderBy('tgl_periksa', 'desc')
            ->get();

        return view('dokter.periksa.index', compact('periksas'));
    }

    public function edit($id)
    {
        $periksa = Periksa::with(['pasien', 'obats'])->findOrFail($id);
        $obats = Obat::all();

        return view('dokter.periksa.edit', compact('periksa', 'obats'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string',
            'biaya_periksa' => 'required|numeric|min:0',
            'obat' => 'required|array',
            'obat.*' => 'exists:obat,id',
        ]);

        $periksa = Periksa::findOrFail($id);
        
        $periksa->update([
            'catatan' => $request->catatan,
            'biaya_periksa' => $request->biaya_periksa,
        ]);

        // Sync obat-obatan
        $periksa->obats()->sync($request->obat);

        return redirect()->route('dokter.periksa.index')
            ->with('success', 'Data pemeriksaan berhasil diperbarui');
    }
}