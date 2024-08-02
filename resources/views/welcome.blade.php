@extends('layouts.navapp')

@section('content')
<div class="container d-flex justify-content-center align-items-center flex-grow-1">
    <div class="row">
        <div class="col text-center">
            <p class="fw-bold display-6 mb-4">SELAMAT DATANG DI PORTAL LAYANAN BKPSDM KOTA BLITAR</p>
            <a href="{{ route('login') }}" class="btn btn-block btn-custom text-light" style="max-width: 200px; background-color:#45383F">Masuk</a>
        </div>
    </div>
</div>
@endsection
