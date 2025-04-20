@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Formulir Pemeriksaan</h1>
        <a href="{{ route('pasien.riwayat') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Ajukan Pemeriksaan Baru</h6>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('pasien.periksa.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_pasien" class="font-weight-bold">Nama Pasien</label>
                            <input type="text" id="nama_pasien" class="form-control" 
                                   value="{{ auth()->user()->nama }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_dokter" class="font-weight-bold">Pilih Dokter <span class="text-danger">*</span></label>
                            <select name="id_dokter" id="id_dokter" class="form-control select2" required>
                                <option value="">-- Pilih Dokter --</option>
                                @foreach($dokters as $dokter)
                                    <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="keluhan" class="font-weight-bold">Keluhan <span class="text-danger">*</span></label>
                    <textarea name="keluhan" id="keluhan" class="form-control" rows="5" 
                              placeholder="Deskripsikan keluhan Anda secara detail..." required></textarea>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-paper-plane mr-2"></i> Ajukan Pemeriksaan
                    </button>
                    <button type="reset" class="btn btn-outline-secondary ml-2">
                        <i class="fas fa-undo mr-2"></i> Reset Form
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    .select2-container .select2-selection--single {
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(1.5em + 0.75rem + 2px);
    }
    
    .card {
        border-radius: 0.5rem;
    }
    
    .alert {
        border-radius: 0.5rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
@endsection