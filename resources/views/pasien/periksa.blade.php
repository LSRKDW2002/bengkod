<!-- periksa.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Formulir Pemeriksaan</h2>

        <!-- Jika terdapat pesan sukses -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form untuk pemeriksaan -->
        <form action="{{ route('pasien.periksa.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_pasien">Nama Pasien:</label>
                <input type="text" id="nama_pasien" name="nama_pasien" class="form-control" value="{{ auth()->user()->nama }}" disabled>
            </div>

            <div class="form-group">
                <label for="id_dokter">Pilih Dokter:</label>
                <select name="id_dokter" id="id_dokter" class="form-control" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($dokters as $dokter)
                        <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="keluhan">Keluhan:</label>
                <textarea name="keluhan" id="keluhan" class="form-control" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan Pemeriksaan</button>
            </div>
        </form>
    </div>
@endsection
