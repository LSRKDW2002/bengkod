@php
    $role = Auth::check() ? Auth::user()->role : null;
@endphp

@if ($role === 'dokter')
    <li class="nav-item">
        <a href="{{ route('dokter.periksa') }}" class="nav-link {{ request()->is('dokter/periksa*') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Periksa</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('dokter.obat') }}" class="nav-link {{ request()->is('dokter/obat*') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Obat</p>
        </a>
    </li>
@elseif ($role === 'pasien')
    <li class="nav-item">
        <a href="{{ route('pasien.periksa') }}" class="nav-link {{ request()->is('pasien/periksa*') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Periksa</p>
        </a>
    </li>
@endif
