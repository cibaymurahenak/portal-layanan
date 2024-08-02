<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKOI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href='{{ Vite::asset('resources/images/sikoi_logo.png') }}' rel="shortcut icon">
    {{-- @vite('resources/sass/app.scss') --}}
    <style>
        header {
            background-color: #ECF9FF;
        }
        footer {
            background-color: #ECF9FF;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <header class="">
        <nav class="navbar ">
            <div class="container d-flex justify-content-center">
                <img src="{{ Vite::asset('resources/images/sikoi.png') }}" alt="SIKOI Logo" height="80" class="d-inline-block align-text-center">
            </div>
        </nav>
    </header>

    <main class="d-flex justify-content-center align-items-start">
        @yield('content')
    </main>

    <footer class="py-3 text-center mt-auto">
        <p class="fw-bold mb-0">Pemerintah Kota Blitar</p>
        <p class="mb-0 text-dark">Badan Kepegawaian Dan Pengembangan Sumber Daya Manusia 2024</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @vite('resources/js/app.js')
</body>
</html>
