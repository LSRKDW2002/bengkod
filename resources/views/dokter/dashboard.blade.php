@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @php
            $cards = [
                ['title' => 'Jumlah Pasien Perlu Periksa', 'color' => 'bg-gradient-primary', 'icon' => 'fas fa-user-md'],
                ['title' => 'Jumlah Obat', 'color' => 'bg-gradient-success', 'icon' => 'fas fa-pills'],
                ['title' => 'User Registration', 'color' => 'bg-gradient-warning', 'icon' => 'fas fa-user-plus'],
                ['title' => 'Unique Visitors', 'color' => 'bg-gradient-danger', 'icon' => 'fas fa-chart-line'],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-md-3 mb-4">
                <div class="card text-white {{ $card['color'] }}">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title">{{ $card['title'] }}</h5>
                            <h3>0</h3> {{-- Ganti sesuai data --}}
                        </div>
                        <i class="{{ $card['icon'] }} fa-2x"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
