@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Riwayat Pemeriksaan</h3>
        <div class="card-tools">
            <input type="text" class="form-control input-sm" placeholder="Search...">
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Periksa</th>
                    <th>Dokter</th>
                    <th>Tanggal</th>
                    <th>Catatan</th>
                    <th>Obat</th>
                    <th>Biaya</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>PX001</td>
                    <td>Dr. Andi</td>
                    <td>2025-04-01</td>
                    <td>Sakit kepala ringan</td>
                    <td>Paracetamol</td>
                    <td>Rp 50.000</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>PX002</td>
                    <td>Dr. Clara</td>
                    <td>2025-04-03</td>
                    <td>Demam tinggi</td>
                    <td>Ibuprofen</td>
                    <td>Rp 75.000</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
