@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>PEGAWAI</h1>
        {{-- button search --}}
        <div class="d-flex justify-content-center mt-3">
            <div class="input-group w-50">
                <form action="{{ route('cari-pegawai') }}" method="POST" class="d-flex w-100">
                    @csrf
                    <input type="search" name="search" id="form1" class="form-control" placeholder="Search pegawai" />
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">Nama Pegawai</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">OPD</th>
                        <th scope="col">Jenis Jabatan</th>
                        <th scope="col">Profile</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($pegawaiData) && count($pegawaiData) > 0)
                        @foreach($pegawaiData as $pegawai)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $pegawai['nama'] }}</td>
                                <td>{{ $pegawai['nip'] }}</td>
                                <td>{{ $pegawai['jabatan'] }}</td>
                                <td>{{ $pegawai['opd'] }}</td>
                                <td>{{ $pegawai['jenis_jabatan'] }}</td>
                                <td><button class="btn btn-primary" data-toggle="modal" data-target="#profileModal" data-nip="{{ $pegawai['nip'] }}">SEE PROFILE</button></td>
                            </tr>
                        @endforeach
                    @else
                        <p>No data found.</p>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">PROFILE PEGAWAI</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img id="profileImage" src="" class="img-fluid" alt="Profile Image">
                        </div>
                        <div class="col-md-6">
                            <div>
                                <h5 id="profileName"></h5>
                                <p><strong>Jabatan:</strong> <span id="profileJabatan"></span></p>
                                <p><strong>NIP:</strong> <span id="profileNip"></span></p>
                                <p><strong>Agama:</strong> <span id="profileAgama"></span></p>
                                <p><strong>Jenis Kelamin:</strong> <span id="profileJenisKelamin"></span></p>
                                <p><strong>Gol:</strong> <span id="profileGol"></span></p>
                                <p><strong>Pendidikan Terakhir:</strong> <span id="profilePendidikanTerakhir"></span></p>
                                <p><strong>Jenis Jabatan:</strong> <span id="profileJenisJabatan"></span></p>
                                <p><strong>OPD:</strong> <span id="profileOpd"></span></p>
                                <p><strong>Status Pegawai:</strong> <span id="profileStatusPegawai"></span></p>
                                <p><strong>NIPX:</strong> <span id="profileNipx"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#profileModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var nip = button.data('nip');
            console.log('NIP:', nip);

            var modal = $(this);
            $.ajax({
                url: '/api/profil-pegawai/' + nip,
                method: 'GET',
                success: function(response) {
                    console.log('API Response:', response);
                    if(response) {
                        modal.find('#profileName').text(response.nama);
                        modal.find('#profileJabatan').text(response.jabatan);
                        modal.find('#profileNip').text(response.nip);
                        modal.find('#profileAgama').text(response.agama);
                        modal.find('#profileJenisKelamin').text(response.jenis_kelamin);
                        modal.find('#profileGol').text(response.gol);
                        modal.find('#profilePendidikanTerakhir').text(response.pendidikan_terakhir);
                        modal.find('#profileJenisJabatan').text(response.jenis_jabatan);
                        modal.find('#profileOpd').text(response.opd);
                        modal.find('#profileStatusPegawai').text(response.status_pegawai);
                        modal.find('#profileNipx').text(response.nipx);
                        modal.find('#profileImage').attr('src', response.foto);
                    } else {
                        console.error('Empty response');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('API Error:', error);
                }
            });
        });
    });
</script>
@endsection
