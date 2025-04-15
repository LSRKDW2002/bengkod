@extends('layouts.app')
@php use Carbon\Carbon; @endphp

@section('content')
<div class="container-fluid py-4">
    <h4 class="mb-4">Daftar Pemeriksaan</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" class="form-control" id="searchInput" placeholder="Cari nama pasien...">
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover" id="periksaTable">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Tanggal</th>
                        <th>Catatan</th>
                        <th>Biaya</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($periksas as $index => $periksa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $periksa->pasien->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d M Y') }}</td>
                            <td>{{ $periksa->catatan }}</td>
                            <td>Rp{{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('dokter.periksa.edit', $periksa->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#periksaTable tbody tr");

        rows.forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(filter) ? "" : "none";
        });
    });
</script>
@endpush
@endsection
