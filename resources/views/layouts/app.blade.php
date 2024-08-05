<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKOI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <link href='{{ Vite::asset('resources/images/sikoi_logo.png') }}' rel="shortcut icon">
    <style>
        body {
            display: flex;
        }
        .sidebar {
            background-color: #ECF9FF;
            min-width: 250px;
            max-width: 250px;
            min-height: 100vh;
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: #000;
            margin: 10px 0;
        }
        .sidebar .nav-link.active {
            background-color: #007bff;
            color: white !important;
            border-radius: 5px;
        }
        .logout-hover:hover {
            background-color: red;
            color: white;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .user-info {
            padding: 20px;
            text-align: center;
        }
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
        }
        .copyright{
            text-align: center;
        }
    </style>
    <script>
        function confirmLogout(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin ingin keluar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, keluar',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logoutForm').submit();
                }
            });
        }
    </script>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar">
            <div style="text-align: center">
                <img src="{{ Vite::asset('resources/images/sikoi_logo.png') }}" alt="SIKOI Logo" height="60">
            </div>
            <div class="user-info">
                <img src="{{ session('profile_photo') }}" alt="User Image" class="img-fluid rounded-circle" width="100">
                <h5 class="mt-2">{{ session('sso_data')['nama'] }}</h5>
                <a href="{{ asset('storage/pdf/SIKOI.pdf') }}" class="btn btn-danger mt-2" download="catatan-sikoi.pdf">
                    <i class="bi bi-file-earmark-pdf-fill"></i> Sebuah Catatan
                </a>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door-fill"></i> Aplikasi Pegawai
                </a>
                <a class="nav-link {{ Request::routeIs('pegawai') ? 'active' : '' }}" href="{{ route('pegawai') }}">
                    <i class="bi bi-search"></i> Cari Pegawai
                </a>
                <a class="nav-link {{ Request::routeIs('show-change-password-form') ? 'active' : '' }}" href="{{ route('show-change-password-form') }}">
                    <i class="bi bi-key-fill"></i> Reset Password
                </a>
                <a class="nav-link {{ Request::routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                    <i class="bi bi-person-fill"></i> Profile
                </a>
                {{-- <a class="nav-link logout-hover" href="#" onclick="confirmLogout(event)">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </a> --}}
            </nav>
            {{-- <div class="copyright">
                <p class="mt-5">Bada Kepegawaian Kota Blitar</p>
                <p>2024</p>
            </div> --}}
        </div>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
        <div class="offcanvas-header">
            <img src="{{ Vite::asset('resources/images/sikoi.png') }}" alt="SIKOI Logo" height="60">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="user-info">
                <img src="{{ session('profile_photo') }}" alt="User Image" class="img-fluid rounded-circle" width="100">
                <h5 class="mt-2">{{ session('sso_data')['nama'] }}</h5>
                <!-- Tambahkan tombol unduh PDF di sini -->
                <a href="{{ asset('path/to/your/file.pdf') }}" class="btn btn-primary mt-2" download="filename.pdf">
                    <i class="bi bi-file-earmark-pdf-fill"></i> Download PDF
                </a>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door-fill"></i> Aplikasi Pegawai
                </a>
                <a class="nav-link {{ Request::routeIs('pegawai') ? 'active' : '' }}" href="{{ route('pegawai') }}">
                    <i class="bi bi-search"></i> Cari Pegawai
                </a>
                <a class="nav-link {{ Request::routeIs('show-change-password-form') ? 'active' : '' }}" href="{{ route('show-change-password-form') }}">
                    <i class="bi bi-key-fill"></i> Reset Password
                </a>
                <a class="nav-link {{ Request::routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                    <i class="bi bi-person-fill"></i> Profile
                </a>
            </nav>
            {{-- <div class="copyright">
                <p class="mt-5">Bada Kepegawaian Kota Blitar</p>
                <p>2024</p>
            </div> --}}
        </div>
    </div>

    <div class="content">
        <header class="py-3">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                        <i class="bi bi-list"></i> Menu
                    </button>
                    <div class="d-flex align-items-center ms-auto">
                        <div class="dropdown">
                            <button class="btn btn-danger d-flex align-items-center" type="button" onclick="confirmLogout(event)">
                                <span class="me-2">Keluar</span>
                                <i class="bi bi-box-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
            @stack('scripts')
        </main>

        <footer class="py-3 text-center">
        </footer>
    </div>

    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
