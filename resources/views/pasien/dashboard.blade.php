@extends('layouts.app')

@php
    // Fallback untuk semua variabel yang mungkin tidak terdefinisi
    $riwayat = $riwayat ?? collect([]);
    $riwayat24Jam = $riwayat24Jam ?? collect([]);
    $aktivitasTerkini = $aktivitasTerkini ?? collect([]);
    
    // Status colors mapping
    $statusColors = [
        'selesai' => 'success',
        'proses' => 'warning',
        'menunggu' => 'info',
        'dibatalkan' => 'danger',
        'belum diperiksa' => 'secondary'
    ];
@endphp

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Pasien</h1>
        <a href="{{ route('pasien.periksa') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle mr-2"></i> Ajukan Pemeriksaan
        </a>
    </div>

    <!-- Cards Row -->
    <div class="row">
        <!-- Card 1: Total Pemeriksaan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pemeriksaan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $riwayat->count() }}
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('pasien.riwayat') }}" class="text-primary small font-weight-bold">
                                    Lihat Riwayat <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-medical fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Pemeriksaan Terakhir -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pemeriksaan Terakhir</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @if($riwayat->isNotEmpty())
                                    {{ $riwayat->first()->tgl_periksa->format('d M Y') }}
                                @else
                                    Belum ada
                                @endif
                            </div>
                            <div class="mt-2">
                                @if($riwayat->isNotEmpty())
                                <a href="{{ route('pasien.periksa.detail', $riwayat->first()->id) }}" class="text-success small font-weight-bold">
                                    Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Status Terakhir -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Status Terakhir</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @if($riwayat->isNotEmpty())
                                    <span class="badge bg-{{ $riwayat->first()->status_color }}">
                                        {{ ucfirst($riwayat->first()->status) }}
                                    </span>
                                @else
                                    -
                                @endif
                            </div>
                            <div class="mt-2">
                                @if($riwayat->isNotEmpty() && $riwayat->first()->obats->isNotEmpty())
                                <a href="{{ route('pasien.periksa.detail', $riwayat->first()->id) }}" class="text-info small font-weight-bold">
                                    Lihat Resep <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4: Total Biaya -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Biaya</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @if($riwayat->isNotEmpty())
                                    Rp {{ number_format($riwayat->sum('biaya_periksa') + $riwayat->sum(function($item) {
                                        return $item->obats->sum('harga');
                                    }), 0, ',', '.') }}
                                @else
                                    Rp 0
                                @endif
                            </div>
                            <div class="mt-2">
                                <a href="#" class="text-warning small font-weight-bold">
                                    Lihat Pembayaran <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">Aktivitas 24 Jam Terakhir</h6>
                    <a href="{{ route('pasien.riwayat') }}" class="btn btn-sm btn-outline-light">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    @if($riwayat24Jam->isEmpty())
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-info-circle fa-3x mb-3"></i>
                            <h4>Tidak ada aktivitas dalam 24 jam terakhir</h4>
                            <p class="mt-3">
                                <a href="{{ route('pasien.periksa') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle mr-2"></i> Ajukan Pemeriksaan Baru
                                </a>
                            </p>
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach($riwayat24Jam as $periksa)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 font-weight-bold">
                                            Pemeriksaan dengan Dr. {{ $periksa->dokter->name ?? 'Tidak diketahui' }}
                                        </h6>
                                        <small class="text-muted">
                                            <i class="far fa-clock mr-1"></i>
                                            {{ $periksa->tgl_periksa->format('d M Y H:i') }}
                                        </small>
                                    </div>
                                    <div>
                                        <span class="badge bg-{{ $periksa->status_color }}">
                                            {{ ucfirst($periksa->status) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <p class="mb-1">
                                        <strong>Keluhan:</strong> {{ Str::limit($periksa->keluhan, 70) }}
                                    </p>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('pasien.periksa.detail', $periksa->id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye mr-1"></i> Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">Aktivitas Terkini</h6>
                    <a href="{{ route('pasien.riwayat') }}" class="btn btn-sm btn-outline-light">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    @if($aktivitasTerkini->isEmpty())
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-info-circle fa-3x mb-3"></i>
                            <h4>Belum ada aktivitas pemeriksaan</h4>
                            <p class="mt-3">
                                <a href="{{ route('pasien.periksa') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle mr-2"></i> Ajukan Pemeriksaan
                                </a>
                            </p>
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach($aktivitasTerkini as $periksa)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 font-weight-bold">
                                            Pemeriksaan dengan Dr. {{ $periksa->dokter->name ?? 'Tidak diketahui' }}
                                        </h6>
                                        <small class="text-muted">
                                            <i class="far fa-clock mr-1"></i>
                                            {{ $periksa->tgl_periksa->format('d M Y H:i') }}
                                        </small>
                                    </div>
                                    <div>
                                        <span class="badge bg-{{ $periksa->status_color }}">
                                            {{ ucfirst($periksa->status) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <p class="mb-1">
                                        <strong>Keluhan:</strong> {{ Str::limit($periksa->keluhan, 70) }}
                                    </p>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('pasien.periksa.detail', $periksa->id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye mr-1"></i> Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
    }
    
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }
    
    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }
    
    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }
    
    .border-left-warning {
        border-left: 0.25rem solid #f6c23e !important;
    }
    
    .badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.35em 0.65em;
    }
    
    .list-group-item {
        transition: all 0.2s ease;
    }
    
    .list-group-item:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
</style>
@endpush
@endsection