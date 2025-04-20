@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <div class="d-flex">
            <div class="dropdown mr-2">
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Hari Ini</a>
                    <a class="dropdown-item" href="#">Minggu Ini</a>
                    <a class="dropdown-item" href="#">Bulan Ini</a>
                    <a class="dropdown-item" href="#">Tahun Ini</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards Row -->
    <div class="row">
        @php
            $cards = [
                [
                    'title' => 'Pasien Perlu Periksa',
                    'value' => '24',
                    'change' => '+4.5%',
                    'color' => 'primary',
                    'icon' => 'fas fa-user-md',
                    'progress' => 65
                ],
                [
                    'title' => 'Total Obat Tersedia',
                    'value' => '128',
                    'change' => '+12%',
                    'color' => 'success',
                    'icon' => 'fas fa-pills',
                    'progress' => 80
                ],
                [
                    'title' => 'Kunjungan Hari Ini',
                    'value' => '42',
                    'change' => '-2.3%',
                    'color' => 'info',
                    'icon' => 'fas fa-procedures',
                    'progress' => 50
                ],
                [
                    'title' => 'Pendapatan Bulan Ini',
                    'value' => 'Rp8.250.000',
                    'change' => '+18%',
                    'color' => 'warning',
                    'icon' => 'fas fa-dollar-sign',
                    'progress' => 75
                ]
            ];
        @endphp

        @foreach ($cards as $card)
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-{{ $card['color'] }} shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-{{ $card['color'] }} text-uppercase mb-1">
                                {{ $card['title'] }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $card['value'] }}</div>
                            <div class="mt-2">
                                <span class="{{ $card['change'][0] === '+' ? 'text-success' : 'text-danger' }} small font-weight-bold">
                                    {{ $card['change'] }}
                                </span>
                                <span class="text-muted small">vs bulan lalu</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="{{ $card['icon'] }} fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="progress" style="height: 10px;">
    <div class="progress-bar bg-{{ $card['color'] }} progress-bar-striped" 
         role="progressbar" 
         style="width: {{ $card['progress'] }}%"
         aria-valuenow="{{ $card['progress'] }}" 
         aria-valuemin="0" 
         aria-valuemax="100">
    </div>
</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Line Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Kunjungan Pasien</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" 
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Opsi:</div>
                            <a class="dropdown-item" href="#">Lihat Detail</a>
                            <a class="dropdown-item" href="#">Ekspor Data</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Sembunyikan Grafik</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="patientVisitChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Distribusi Pasien</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" 
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Opsi:</div>
                            <a class="dropdown-item" href="#">Lihat Detail</a>
                            <a class="dropdown-item" href="#">Ekspor Data</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="patientDistributionChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Laki-laki
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Perempuan
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Anak-anak
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aktivitas Terkini</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="recentActivityTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Waktu</th>
                                    <th>Aktivitas</th>
                                    <th>Pengguna</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>10 menit lalu</td>
                                    <td>Pemeriksaan baru pasien atas nama Heru</td>
                                    <td>Dr. Joni</td>
                                    <td><span class="badge badge-success">Selesai</span></td>
                                </tr>
                                <tr>
                                    <td>30 menit lalu</td>
                                    <td>Pendaftaran pasien baru</td>
                                    <td>Siti Rahayu</td>
                                    <td><span class="badge badge-warning">Menunggu</span></td>
                                </tr>
                                <tr>
                                    <td>1 jam lalu</td>
                                    <td>Update data obat</td>
                                    <td>Admin Farmasi</td>
                                    <td><span class="badge badge-info">Diproses</span></td>
                                </tr>
                                <tr>
                                    <td>2 jam lalu</td>
                                    <td>Pembayaran pemeriksaan</td>
                                    <td>Rina Wijaya</td>
                                    <td><span class="badge badge-success">Lunas</span></td>
                                </tr>
                                <tr>
                                    <td>3 jam lalu</td>
                                    <td>Resep obat baru</td>
                                    <td>dr. Budi</td>
                                    <td><span class="badge badge-primary">Diterbitkan</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Patient Visit Chart
    var ctx = document.getElementById('patientVisitChart').getContext('2d');
    var patientVisitChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Kunjungan Pasien',
                data: [65, 59, 80, 81, 56, 55, 40, 72, 88, 94, 101, 86],
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                borderColor: 'rgba(78, 115, 223, 1)',
                pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' pasien';
                        }
                    }
                }
            }
        }
    });

    // Patient Distribution Chart
    var ctx2 = document.getElementById('patientDistributionChart').getContext('2d');
    var patientDistributionChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan', 'Anak-anak'],
            datasets: [{
                data: [55, 30, 15],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            cutout: '70%',
        },
    });
</script>
@endpush

@push('styles')
<style>
    .card {
        border-radius: 0.35rem;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.2);
    }
    
    .border-left-primary {
        border-left: 0.25rem solid #4e73df;
    }
    
    .border-left-success {
        border-left: 0.25rem solid #1cc88a;
    }
    
    .border-left-info {
        border-left: 0.25rem solid #36b9cc;
    }
    
    .border-left-warning {
        border-left: 0.25rem solid #f6c23e;
    }
    
    .chart-area {
        position: relative;
        height: 20rem;
    }
    
    .chart-pie {
        position: relative;
        height: 15rem;
    }
    
    .progress-sm {
        height: 0.5rem;
    }
</style>
@endpush
@endsection