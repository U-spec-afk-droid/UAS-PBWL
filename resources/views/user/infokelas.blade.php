@extends('layouts.user')

@section('content')
@php $active = 'infokelas'; @endphp

<div class="card">
    <h2>📚 Daftar Ruangan Kelas</h2>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Ruangan</th>
                <th>Kapasitas</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ruangan as $r)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $r->kode_ruangan }}</td>
                    <td>{{ $r->nama_ruangan }}</td>
                    <td>{{ $r->kapasitas }}</td>
                    <td>
                        <span class="status-{{ $r->status }}">
                            {{ ucfirst($r->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="empty-message">Belum ada data ruangan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
