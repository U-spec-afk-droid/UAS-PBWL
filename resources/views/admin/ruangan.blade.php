@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="fw-bold mb-3">Manajemen Ruangan</h2>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tombol Tambah --}}
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
        Tambah Ruangan
    </button>

    {{-- TABLE --}}
    <table class="table table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Nama Ruangan</th>
                <th>Kapasitas</th>
                <th>Status</th>
                <th width="200px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ruangans as $r)
            <tr>
                <td>{{ $r->kode_ruangan }}</td>
                <td>{{ $r->nama_ruangan }}</td>
                <td>{{ $r->kapasitas }}</td>
                <td>{{ $r->status }}</td>
                <td>
                    {{-- EDIT --}}
                    <button class="btn btn-warning btn-sm"
                        data-bs-toggle="modal" data-bs-target="#modalEdit{{ $r->id }}">
                        Edit
                    </button>

                    {{-- DELETE --}}
                    <form action="{{ route('admin.ruangan.delete', $r->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus ruangan?')">Hapus</button>
                    </form>
                </td>
            </tr>

            {{-- Modal Edit --}}
            <div class="modal fade" id="modalEdit{{ $r->id }}">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('admin.ruangan.update', $r->id) }}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header"><h5>Edit Ruangan</h5></div>
                            <div class="modal-body">
                                <input class="form-control mb-2" name="kode_ruangan" value="{{ $r->kode_ruangan }}">
                                <input class="form-control mb-2" name="nama_ruangan" value="{{ $r->nama_ruangan }}">
                                <input class="form-control mb-2" name="kapasitas" type="number" value="{{ $r->kapasitas }}">

                                <select class="form-control" name="status">
                                    <option value="kosong" {{ $r->status=='kosong' ? 'selected':'' }}>Kosong</option>
                                    <option value="dibooking" {{ $r->status=='dibooking' ? 'selected':'' }}>Dibooking</option>
                                    <option value="digunakan" {{ $r->status=='digunakan' ? 'selected':'' }}>Digunakan</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @endforeach
        </tbody>
    </table>


    {{-- Modal Tambah --}}
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.ruangan.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header"><h5>Tambah Ruangan</h5></div>
                    <div class="modal-body">
                        <input class="form-control mb-2" name="kode_ruangan" placeholder="Kode Ruangan">
                        <input class="form-control mb-2" name="nama_ruangan" placeholder="Nama Ruangan">
                        <input class="form-control mb-2" name="kapasitas" type="number" placeholder="Kapasitas">

                        <select class="form-control" name="status">
                            <option value="kosong">Kosong</option>
                            <option value="dibooking">Dibooking</option>
                            <option value="digunakan">Digunakan</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
