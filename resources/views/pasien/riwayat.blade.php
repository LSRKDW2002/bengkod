@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Riwayat Pemeriksaan</h2>

        <!-- Jika pasien tidak memiliki riwayat pemeriksaan -->
        @if($riwayat->isEmpty())
            <div class="alert alert-info">
                Anda belum memiliki riwayat pemeriksaan.
            </div>
        @else
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Dokter</th>
                        <th>Tanggal Pemeriksaan</th>
                        <th>Status Pemeriksaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayat as $index => $periksa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $periksa->dokter->nama }}</td>
                            <td>{{ $periksa->tgl_periksa->format('d-m-Y H:i') }}</td>

                            <!-- Status Pemeriksaan -->
                            <td>
                                @if(empty($periksa->catatan) && empty($periksa->obat))
                                    <span class="badge bg-warning text-dark">Belum</span>
                                @else
                                    <span class="badge bg-success">Sudah</span>
                                @endif
                            </td>

                            <!-- Aksi: Lihat Detail -->
                            <td>
                                <a href="{{ route('pasien.periksa.detail', $periksa->id) }}" class="btn btn-info btn-sm">Lihat Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
