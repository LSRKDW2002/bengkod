@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Pemeriksaan</h3>
    </div>
    <div class="card-body">
        <form>
            <div class="form-group">
                <label for="nama">Nama Pasien</label>
                <input type="text" class="form-control" id="nama" placeholder="Masukkan nama">
            </div>
            <div class="form-group">
                <label for="dokter">Pilih Dokter</label>
                <select class="form-control" id="dokter">
                    <option>Dr. Andi</option>
                    <option>Dr. Budi</option>
                    <option>Dr. Clara</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Periksa</button>
        </form>
    </div>
</div>
@endsection
