@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Data Obat</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Obat</button>
    </div>

    <input type="text" class="form-control mb-3" id="searchInput" placeholder="Cari obat...">

    <table class="table table-bordered" id="obatTable">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>ID Obat</th>
                <th>Nama Obat</th>
                <th>Kemasan</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 1; $i <= 5; $i++)
                <tr>
                    <td>{{ $i }}</td>
                    <td>OBT00{{ $i }}</td>
                    <td>Obat {{ $i }}</td>
                    <td>Kemasan {{ $i }}</td>
                    <td>Rp{{ number_format(10000 * $i, 0, ',', '.') }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning">Edit</button>
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>
</div>

<!-- Modal Tambah Obat -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Nama Obat</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Kemasan</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Harga</label>
                    <input type="number" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#obatTable tbody tr");

        rows.forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(filter) ? "" : "none";
        });
    });
</script>
@endsection
