@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pemeriksaan</h1>
        <a href="{{ route('pasien.riwayat') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Informasi Pemeriksaan</h6>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-light">
                            <h6 class="m-0 font-weight-bold">Detail Pemeriksaan</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">Tanggal Pemeriksaan</th>
                                    <td>{{ $periksa->tgl_periksa->format('d F Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Dokter</th>
                                    <td>{{ $periksa->dokter->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge bg-{{ $periksa->status_color }}">
                                            {{ $periksa->status }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h6 class="m-0 font-weight-bold">Informasi Biaya</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">Biaya Pemeriksaan</th>
                                    <td>Rp {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</td>
                                </tr>
                                @if($periksa->obats->isNotEmpty())
                                <tr>
                                    <th>Total Biaya Obat</th>
                                    <td>Rp {{ number_format($periksa->obats->sum('harga'), 0, ',', '.') }}</td>
                                </tr>
                                <tr class="font-weight-bold">
                                    <th>Total Keseluruhan</th>
                                    <td>Rp {{ number_format($periksa->biaya_periksa + $periksa->obats->sum('harga'), 0, ',', '.') }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-light">
                            <h6 class="m-0 font-weight-bold">Keluhan Pasien</h6>
                        </div>
                        <div class="card-body">
                            <div class="p-3 border rounded">
                                {!! nl2br(e($periksa->keluhan)) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-light">
                            <h6 class="m-0 font-weight-bold">Catatan Dokter</h6>
                        </div>
                        <div class="card-body">
                            @if($periksa->catatan)
                                <div class="p-3 border rounded">
                                    {!! nl2br(e($periksa->catatan)) !!}
                                </div>
                            @else
                                <div class="text-center text-muted py-4">
                                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                                    <p>Belum ada catatan dari dokter</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if($periksa->obats->isNotEmpty())
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h6 class="m-0 font-weight-bold">Resep Obat</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Nama Obat</th>
                                            <th>Kemasan</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($periksa->obats as $obat)
                                        <tr>
                                            <td>{{ $obat->nama_obat }}</td>
                                            <td>{{ $obat->kemasan }}</td>
                                            <td>Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="mt-4 text-center">
                <a href="{{ route('pasien.riwayat') }}" class="btn btn-secondary mr-2">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                @if($periksa->status == 'Belum Diperiksa')
                <button class="btn btn-danger" disabled>
                    <i class="fas fa-times mr-2"></i> Batalkan Pemeriksaan
                </button>
                @endif
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        border-radius: 0.5rem;
    }
    
    .table-borderless td, .table-borderless th {
        border: 0;
    }
    
    .border {
        border-radius: 0.35rem;
    }
</style>
@endpush
@endsection