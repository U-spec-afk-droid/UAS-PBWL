@extends('app')

@section('title', 'Home')

@section('content')
<h4>Informasi Ruangan Kelas</h4>

<div class="row mt-3">

@foreach ($ruangan as $r)
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                {{ $r->nama_ruangan }}
            </div>

            <div class="card-body">
                <p>Kode Ruangan : {{ $r->kode_ruangan }}</p>
                <p>Kapasitas     : {{ $r->kapasitas }} orang</p>
                <p>Status        : 
                    <strong>{{ ucfirst($r->status) }}</strong>
                </p>
            </div>
        </div>
    </div>
@endforeach

</div>
@endsection
