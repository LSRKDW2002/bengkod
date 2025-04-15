@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Pemeriksaan</h2>
        
        <table class="table table-bordered">
            <tr>
                <th>Dokter</th>
                <td>{{ $periksa->dokter->nama }}</td>
            </tr>
            <tr>
                <th>Tanggal Pemeriksaan</th>
                <td>{{ $periksa->tgl_periksa->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th>Keluhan</th>
                <td>{{ $periksa->keluhan }}</td>
            </tr>
            <tr>
                <th>Catatan Dokter</th>
                <td>{{ $periksa->catatan ?? '-' }}</td>
            </tr>
            <tr>
                <th>Obat</th>
                <td>{{ $periksa->obat ?? '-' }}</td>
            </tr>
            <tr>
                <th>Biaya Pemeriksaan</th>
                <td>Rp. {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</td>
            </tr>
        </table>
        <a href="{{ route('pasien.riwayat') }}" class="btn btn-primary">Kembali ke Riwayat Pemeriksaan</a>
    </div>
@endsection
