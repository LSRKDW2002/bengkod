@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Periksa Pasien</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('dokter.periksa.update', $periksa->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Pasien</label>
                        <input type="text" class="form-control" value="{{ $periksa->pasien->nama }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Pemeriksaan</label>
                        <input type="text" class="form-control" value="{{ $periksa->tgl_periksa->format('d-m-Y') }}" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keluhan</label>
                    <textarea class="form-control" rows="3" readonly>{{ $periksa->keluhan }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Catatan Dokter</label>
                    <textarea name="catatan" class="form-control" rows="5" required>{{ old('catatan', $periksa->catatan) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Obat</label>
                    <select name="obat[]" class="form-control select2" multiple="multiple" required>
                        @foreach ($obats as $obat)
                            <option value="{{ $obat->id }}" 
                                {{ $periksa->obats->contains($obat->id) ? 'selected' : '' }}>
                                {{ $obat->nama_obat }} - {{ $obat->kemasan }} (Rp {{ number_format($obat->harga, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Biaya Pemeriksaan</label>
                    <input type="number" name="biaya_periksa" class="form-control" 
                        value="{{ old('biaya_periksa', $periksa->biaya_periksa) }}" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('dokter.periksa.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Pilih obat",
            allowClear: true
        });
    });
</script>
@endpush
@endsection