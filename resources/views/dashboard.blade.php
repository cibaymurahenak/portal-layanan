@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <h1 class="h2 strong">Aplikasi Pegawai </h1>
    {{-- <div class="d-flex justify-content-center mt-3">
        <form action="{{ route('search') }}" method="POST" class="input-group w-50">
            @csrf
            <input type="search" name="search" id="form1" class="form-control" placeholder="Search aplikasi" />
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div> --}}
    {{-- <div class="d-flex justify-content-center mt-3">
        <span class="d-none d-md-inline">{{ session('sso_data')['jenis_akses'] }}</span>
    </div> --}}

    <div class="row mt-4">
        @if(isset($filteredApps))
            @foreach($filteredApps as $app)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ $app['app_icon'] }}" alt="{{ $app['app_name'] }} Icon" width="50">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="card-title">{{ $app['app_name'] }}</h5>
                                    <p class="card-text">
                                        <a href="{{ $app['app_link'] }}" class="btn btn-primary me-2" target="_blank">Go to App</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            @foreach($ssoData['app'] as $app)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ $app['app_icon'] }}" alt="{{ $app['app_name'] }} Icon" width="50">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="card-title">{{ $app['app_name'] }}</h5>
                                    <p class="card-text">
                                        <a href="{{ $app['app_link'] }}" class="btn btn-primary me-2" target="_blank">Go to App</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="row mt-3">
        @if(isset($pegawaiData) && count($pegawaiData) > 0)
            @foreach($pegawaiData as $pegawai)
                <div class="col-md-4 mb-4 d-flex align-items-stretch">
                    <div class="card w-100">
                        {{-- <img src="{{ Vite::asset('resources/images/default.jpg') }}" class="card-img-top" alt="Pegawai Image"> --}}
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-center">{{ $pegawai['nama'] }}</h5>
                            <p class="card-text text-center">{{ $pegawai['jabatan'] }}</p>
                            <div class="mt-auto">
                                <button class="btn btn-primary w-100" data-toggle="modal" data-target="#profile{{ $pegawai['nip'] }}">SEE PROFILE</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal --}}
                <div class="modal fade" id="profile{{ $pegawai['nip'] }}" tabindex="-1" role="dialog" aria-labelledby="profileLabel{{ $pegawai['nip'] }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="profileLabel{{ $pegawai['nip'] }}">PROFILE PEGAWAI</h5>
                                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> --}}
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    {{-- <div class="col-md-6">
                                        <img src="{{ Vite::asset('resources/images/default.jpg') }}" class="img-fluid" alt="Profile Image">
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div>
                                            <h5>{{ $pegawai['nama'] }}</h5>
                                            <p><strong>Jabatan:</strong> {{ $pegawai['jabatan'] }}</p>
                                            <p><strong>NIP:</strong> {{ $pegawai['nip'] }}</p>
                                            <p><strong>Agama:</strong> {{ $pegawai['agama'] }}</p>
                                            <p><strong>Jenis Kelamin:</strong> {{ $pegawai['jenis_kelamin'] }}</p>
                                            <p><strong>Gol:</strong> {{ $pegawai['gol'] }}</p>
                                            <p><strong>Pendidikan Terakhir:</strong> {{ $pegawai['pendidikan_terakhir'] }}</p>
                                            <p><strong>Jenis Jabatan:</strong> {{ $pegawai['jenis_jabatan'] }}</p>
                                            <p><strong>OPD:</strong> {{ $pegawai['opd'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
