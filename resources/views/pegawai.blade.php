@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>PEGAWAI</h1>
        {{-- button search --}}
        <div class="d-flex justify-content-center mt-3">
            <div class="input-group w-50">
                <form action="{{ route('cari-pegawai') }}" method="POST" class="d-flex w-100" id="searchForm">
                    @csrf
                    <input type="search" name="search" id="form1" class="form-control" placeholder="inputkan nama pegawai/jabatan disini terlebih dahulu" />
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <table id="pegawaiTable" class="table table-striped table-hover">
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
                    {{-- Data will be loaded here via DataTables --}}
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Profile Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="loading" class="text-center my-3" style="display: none;">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div id="profileContent">
                        <!-- Profile content will be loaded here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTables
            var table = $('#pegawaiTable').DataTable({
                columns: [
                    { data: 'no' },
                    { data: 'nama' },
                    { data: 'nip' },
                    { data: 'jabatan' },
                    { data: 'opd' },
                    { data: 'jenis_jabatan' },
                    { data: 'profile', orderable: false, searchable: false }
                ]
            });

            // Handle form submission for search
            $('#searchForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('cari-pegawai') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.data) {
                            var pegawaiData = response.data.map(function(pegawai, index) {
                                return {
                                    no: index + 1,
                                    nama: pegawai.nama,
                                    nip: pegawai.nip,
                                    jabatan: pegawai.jabatan,
                                    opd: pegawai.opd,
                                    jenis_jabatan: pegawai.jenis_jabatan,
                                    profile: `<button type="button" class="btn btn-info" onclick="profil_pegawai('${pegawai.nip}')" data-bs-toggle="modal" data-bs-target="#profileModal">Klik</button>`
                                };
                            });
                            table.clear().rows.add(pegawaiData).draw();
                        } else {
                            table.clear().draw();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Failed to fetch search results');
                        console.error("Error details:", textStatus, errorThrown);
                    }
                });
            });

            window.profil_pegawai = function(nip) {
                console.log("Fetching profile for NIP:", nip);

                $('#loading').show();
                $('#profileContent').html('');

                $.ajax({
                    url: "/api/profil-pegawai/" + nip,
                    method: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log("Profile data:", data);

                        let profileHtml = `
                            <div class="row w-100">
                                <div class="col-md-4 text-center mb-3">
                                    <img src="${data.foto}" class="img-fluid" alt="Profile Picture">
                                </div>
                                <div class="col-md-8">
                                    <p><strong>Nama:</strong> ${data.nama}</p>
                                    <p><strong>NIP:</strong> ${data.nip}</p>
                                    <p><strong>Jabatan:</strong> ${data.jabatan}</p>
                                    <p><strong>OPD:</strong> ${data.opd}</p>
                                    <p><strong>Jenis Jabatan:</strong> ${data.jenis_jabatan}</p>
                                    <p><strong>Pendidikan Terakhir:</strong> ${data.pendidikan_terakhir}</p>
                                    <p><strong>Agama:</strong> ${data.agama}</p>
                                    <p><strong>Jenis Kelamin:</strong> ${data.jenis_kelamin}</p>
                                    <p><strong>Status Pegawai:</strong> ${data.status_pegawai}</p>
                                </div>
                            </div>
                        `;

                        $('#loading').hide();
                        $('#profileContent').html(profileHtml);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#loading').hide();
                        alert('Failed to load profile data');
                        console.error("Error details:", textStatus, errorThrown);
                    }
                });
            }
        });
    </script>
@endpush
