<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Update to latest jQuery -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href='{{ Vite::asset('resources/images/oi.jpeg') }}' rel="shortcut icon">
    @vite('resources/sass/app.scss')
    <style>
        header {
            background-color: #ECF9FF;
        }
        .nav-link.active {
            background-color: #007bff;
            color: white !important;
            border-radius: 5px;
        }
        .logout-hover:hover {
            background-color: red;
            color: white;
        }
        footer {
            background-color: #ECF9FF;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0 d-flex flex-column" style="min-height: 100vh;">
        <header class="py-3 sticky-top">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="{{ Vite::asset('resources/images/sikoi.png') }}" alt="SIKOI Logo" height="60" class="d-inline-block align-top">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('pegawai') ? 'active' : '' }}" href="{{ route('pegawai') }}">Pegawai</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('coba') ? 'active' : '' }}" href="{{ route('coba') }}">Coba</a>
                            </li> --}}
                        </ul>
                    </div>
                    <div class="d-flex align-items-center ms-auto">
                        <div class="dropdown">
                            <button class="dropdown-toggle bg-transparent border-0 d-flex align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="me-2">{{ session('sso_data')['nama'] }}</span>
                                <i class="bi bi-person-circle"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    @if (session('jenis_akses') == 'OPD' || session('jenis_akses') == 'PTT')
                                        <a class="dropdown-item" href="{{ route('show-change-password-form') }}">
                                            Reset Password
                                        </a>
                                    @else
                                        <a class="dropdown-item" href="https://myasn.bkn.go.id/reset-password" target="_blank">
                                            Reset Password
                                        </a>
                                    @endif
                                </li>
                                <li>
                                    <a class="dropdown-item logout-hover" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main class="flex-grow-1">
            @yield('content')
            @stack('scripts')
          {{-- @include('sweetalert::alert') --}}
        </main>

        <footer class="py-3 text-center">
            <p class="fw-bold mb-0">Pemerintah Kota Blitar</p>
            <p class="mb-0 text-dark">Badan Kepegawaian Dan Pengembangan Sumber Daya Manusia 2024</p>
        </footer>
    </div>

    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script> --}}
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
    @vite('resources/js/app.js')
</body>
</html>
