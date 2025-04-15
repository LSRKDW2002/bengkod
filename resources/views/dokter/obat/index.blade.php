@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4>Manajemen Obat</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Obat</button>

    <!-- Tabel -->
    <table class="table table-bordered table-hover">
        <thead class="bg-primary text-white">
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Kemasan</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($obat as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->nama_obat }}</td>
                <td>{{ $item->kemasan }}</td>
                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>
                    <!-- Edit -->
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                        Edit
                    </button>

                    <!-- Hapus -->
                    <form action="{{ route('dokter.obat.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus obat ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-labelledby="editLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog">
                <form action="{{ route('dokter.obat.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Obat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Nama Obat</label>
                                    <input type="text" class="form-control" name="nama_obat" value="{{ $item->nama_obat }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Kemasan</label>
                                    <input type="text" class="form-control" name="kemasan" value="{{ $item->kemasan }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Harga</label>
                                    <input type="number" class="form-control" name="harga" value="{{ $item->harga }}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
    <div class="modal-dialog">
    <form action="{{ route('dokter.obat.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Obat</label>
                        <input type="text" class="form-control" name="nama_obat" required>
                    </div>
                    <div class="mb-3">
                        <label>Kemasan</label>
                        <input type="text" class="form-control" name="kemasan" required>
                    </div>
                    <div class="mb-3">
                        <label>Harga</label>
                        <input type="number" class="form-control" name="harga" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
