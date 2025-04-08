@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Data Periksa</h4>

    <div class="mb-3">
        <input type="text" class="form-control" id="searchInput" placeholder="Cari pasien...">
    </div>

    <table class="table table-bordered" id="periksaTable">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>ID Periksa</th>
                <th>Nama Pasien</th>
                <th>Tanggal Periksa</th>
                <th>Catatan</th>
                <th>Biaya</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 1; $i <= 5; $i++)
                <tr>
                    <td>{{ $i }}</td>
                    <td>PRK00{{ $i }}</td>
                    <td>Pasien {{ $i }}</td>
                    <td>{{ now()->format('Y-m-d') }}</td>
                    <td>Catatan pemeriksaan ke-{{ $i }}</td>
                    <td>Rp{{ number_format(50000 * $i, 0, ',', '.') }}</td>
                </tr>
            @endfor
        </tbody>
    </table>
</div>

<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#periksaTable tbody tr");

        rows.forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(filter) ? "" : "none";
        });
    });
</script>
@endsection
