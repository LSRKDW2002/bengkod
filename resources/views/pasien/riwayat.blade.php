@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Riwayat Pemeriksaan</h1>
        <a href="{{ route('pasien.periksa') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle mr-2"></i> Pemeriksaan Baru
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Daftar Riwayat Pemeriksaan</h6>
        </div>
        <div class="card-body">
            @if($riwayat->isEmpty())
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h4 class="alert-heading">Belum Ada Riwayat Pemeriksaan</h4>
                    <p>Anda belum memiliki riwayat pemeriksaan. Silahkan ajukan pemeriksaan baru.</p>
                    <a href="{{ route('pasien.periksa') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-plus-circle mr-2"></i> Ajukan Pemeriksaan
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="riwayatTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No</th>
                                <th>Tanggal</th>
                                <th>Dokter</th>
                                <th>Keluhan</th>
                                <th>Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayat as $index => $periksa)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $periksa->tgl_periksa->format('d M Y') }}</td>
                                <td>{{ $periksa->dokter->nama }}</td>
                                <td>{{ Str::limit($periksa->keluhan, 50) }}</td>
                                <td>
                                    <span class="badge badge-pill bg-{{ $periksa->status_color }}">
                                        {{ $periksa->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('pasien.periksa.detail', $periksa->id) }}" 
                                       class="btn btn-sm btn-primary" title="Detail">
                                        <i class="fas fa-eye"> Lihat Detail</i>
                                    </a>
                                    @if($periksa->status == 'Belum Diperiksa')
                                    <button class="btn btn-sm btn-warning" title="Batalkan" disabled>
                                        <i class="fas fa-times"></i>
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    #riwayatTable tbody tr {
        transition: all 0.2s ease;
    }
    
    #riwayatTable tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
        transform: translateX(2px);
    }
    
    .badge-pill {
        padding-right: 0.6em;
        padding-left: 0.6em;
    }
    
    .alert {
        border-radius: 0.5rem;
        padding: 2rem;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#riwayatTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            },
            "columnDefs": [
                { "orderable": false, "targets": [0, 5] }
            ],
            "order": [[1, 'desc']]
        });
    });
</script>
@endpush
@endsection