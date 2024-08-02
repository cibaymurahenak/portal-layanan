@extends('layouts.app')

@section('content')
{{-- <a class="btn border-0" href="{{ route('dashboard') }}" role="button">
    <i class="bi bi-arrow-left p-4"></i>
</a> --}}
<div class="d-flex justify-content-center align-items-center w-100">
    <div class="p-4 w-100" style="max-width: 400px;">
        <h1 class="h5 mb-5 text-center">RESET PASSWORD</h1>
        @if(session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger mb-3">
            {{ session('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('change-password') }}">
            @csrf
            <div class="mb-3">
                <label for="password_lama" class="form-label">Password Lama</label>
                <input type="password" id="password_lama" name="password_lama" class="form-control" placeholder="Masukkan Password Lama" required>
            </div>
            <div class="mb-3">
                <label for="password_baru" class="form-label">Password Baru</label>
                <input type="password" id="password_baru" name="password_baru" class="form-control" placeholder="Masukkan Password Baru" required>
            </div>
            <div class="mb-3">
                <label for="password_baru_konfirmasi" class="form-label">Konfirmasi Password Baru</label>
                <input type="password" id="password_baru_konfirmasi" name="password_baru_konfirmasi" class="form-control" placeholder="Konfirmasi Password Baru" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Ganti Password</button>
            </div>
        </form>
    </div>
</div>
@endsection
