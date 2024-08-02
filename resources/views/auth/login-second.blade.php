@extends('layouts.navapp')

@section('content')
<div class="d-flex justify-content-center align-items-center w-50">
    <div class="p-4 w-100" style="max-width: 350px;">
        <h1 class="h5 mb-5 text-center">Sign In Your Account</h1>

        <form method="POST" action="{{ route('login-second') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-3">
                <label for="username" class="form-label">Username (NIP)</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="captcha" class="form-label">Captcha</label>
                <div class="d-flex">
                    <span>{!! captcha_img('default') !!}</span>
                    <button type="button" class="btn btn-secondary ms-2" id="reload-captcha">
                        &#x21bb;
                    </button>
                </div>
                <p class="mt-2" style="color: rgb(27, 2, 189)">Tulis ulang angka pada gambar</p>
                <input type="text" class="form-control @error('captcha') is-invalid @enderror " id="captcha" name="captcha" required>
                @error('captcha')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @if ($errors->has('secondlogin'))
                <div class="alert alert-danger">
                    {{ $errors->first('secondlogin') }}
                </div>
            @endif
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>

<script type="text/javascript">
    document.getElementById('reload-captcha').onclick = function() {
        fetch('/reload-captcha')
            .then(response => response.json())
            .then(data => {
                document.querySelector('span').innerHTML = data.captcha;
            });
    };
</script>
@endsection
