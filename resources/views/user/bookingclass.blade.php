@extends('layouts.user')
@section('title','Booking Kelas')
@section('header','Booking Kelas')

@section('content')
<div class="card">
    @if(session('success'))
        <div style="background:#d1fae5; padding:12px; border-radius:8px; color:#065f46; margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    <h2>📝 Form Booking</h2>
    <form action="{{ route('user.booking.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Jumlah Peserta</label>
            <input type="number" name="jumlah_peserta" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Pilih Ruangan</label>
            <select name="ruangan_id" class="form-select" required>
                @foreach($ruangans as $r)
                    <option value="{{ $r->id }}">{{ $r->kode_ruangan }} — Kapasitas {{ $r->kapasitas }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" rows="3" class="form-textarea"></textarea>
        </div>

        <button type="submit" class="submit-btn">Ajukan Booking</button>
    </form>
</div>
@endsection
