@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Periksa Pasien</div>
    <div class="card-body">
        <form action="{{ route('dokter.periksa.update', $periksa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Pasien</label>
                <input type="text" class="form-control" value="{{ $periksa->pasien->nama }}" readonly>
            </div>

            <div class="form-group">
                <label>Keluhan</label>
                <textarea class="form-control" readonly>{{ $periksa->keluhan }}</textarea>
            </div>

            <div class="form-group">
                <label>Catatan Dokter</label>
                <textarea name="catatan" class="form-control" required>{{ $periksa->catatan }}</textarea>
            </div>

            <div class="form-group">
    <label>Obat</label>
    <select name="obat" class="form-control custom-dropdown" required>
        <option value="">-</option>
        @foreach ($obats as $obat)
            <option value="{{ $obat->id }}"
                {{ $periksa->obats->isNotEmpty() && $periksa->obats->first()->id == $obat->id ? 'selected' : '' }}>
                {{ $obat->nama_obat }}
            </option>
        @endforeach
    </select>
</div>


            <div class="form-group">
                <label>Biaya Pemeriksaan</label>
                <input type="number" name="biaya_periksa" class="form-control" value="{{ $periksa->biaya_periksa }}">
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection
