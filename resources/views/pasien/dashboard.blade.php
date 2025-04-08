@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-gradient-info">
            <div class="inner">
                <h3>4</h3>
                <p>Perlu Periksa</p>
            </div>
            <div class="icon">
                <i class="fas fa-stethoscope"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-gradient-success">
            <div class="inner">
                <h3>12</h3>
                <p>Dokter Aktif</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-md"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-gradient-warning">
            <div class="inner">
                <h3>25</h3>
                <p>Obat Tersedia</p>
            </div>
            <div class="icon">
                <i class="fas fa-pills"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-gradient-danger">
            <div class="inner">
                <h3>300</h3>
                <p>Kunjungan</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
    </div>
</div>
@endsection
