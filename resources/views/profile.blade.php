@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <h1 class="h2 strong">Profile</h1>
    <div class="row">
        {{-- <div class="col-md-4 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img width="150px" src="{{ $profileData['foto'] }}">
                <span class="font-weight-bold mt-3">{{ $profileData['nama'] }}</span>
            </div>
        </div> --}}
        <div class="col-md-12">
            <div class="p-3 py-5">
                <div class="row mt-2">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Nama</h5>
                                <p class="card-text">{{ $profileData['nama'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">NIP</h5>
                                <p class="card-text">{{ $profileData['nip'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Jenis Kelamin</h5>
                                <p class="card-text">{{ $profileData['jenis_kelamin'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">NIPX</h5>
                                <p class="card-text">{{ $profileData['nipx'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Agama</h5>
                                <p class="card-text">{{ $profileData['agama'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Jenis Jabatan</h5>
                                <p class="card-text">{{ $profileData['jenis_jabatan'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Pendidikan Terakhir</h5>
                                <p class="card-text">{{ $profileData['pendidikan_terakhir'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Status Pegawai</h5>
                                <p class="card-text">{{ $profileData['status_pegawai'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Jabatan</h5>
                                <p class="card-text">{{ $profileData['jabatan'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">OPD</h5>
                                <p class="card-text">{{ $profileData['opd'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="{{route('edit-profile')}}" class="btn btn-primary justify-content-center align-items-center" > <i class="bi bi-pencil-square"></i> Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
