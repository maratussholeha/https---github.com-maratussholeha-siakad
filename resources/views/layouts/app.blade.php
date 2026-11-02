<!DOCTYPE html>

{{--
    Nama file : app.blade.php
    NIM       : 3202416144
    Nama      : Mar'atussholeha
--}}

<html lang="id" data-bs-theme="light">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        @yield('title', 'SIAKAD') | {{ config('app.name') }}
    </title>

    {{-- Bootstrap CSS --}}
    <link
        href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}"
        rel="stylesheet"
    >

    {{-- Bootstrap Icons --}}
    <link
        href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}"
        rel="stylesheet"
    >

    {{-- CSS SIAKAD --}}
    <link
        href="{{ asset('css/siakad.css') }}"
        rel="stylesheet"
    >

    @stack('styles')
</head>

<body class="bg-body-tertiary">

    {{-- NAVBAR --}}
    @include('layouts.partials.navbar')

    <div class="container-fluid">
        <div class="row">

            {{-- SIDEBAR --}}
            @include('layouts.partials.sidebar')

            {{-- CONTENT --}}
            <main class="col-lg-9 col-xl-10 px-3 px-md-4 py-4">
				@include('layouts.partials.flash')
                @yield('content')

                {{-- FOOTER --}}
                <footer class="text-center text-body-secondary small mt-5">
                    &copy; {{ date('Y') }}
                    {{ config('app.name') }}
                    - D3 Teknik Informatika
                </footer>
            </main>

        </div>
    </div>

    {{-- Bootstrap JavaScript --}}
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- JavaScript Tema Terang dan Gelap --}}
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const html = document.documentElement;
                const tombol = document.getElementById('themeToggle');
                const ikon = document.getElementById('themeIcon');
                const teks = document.getElementById('themeText');

                if (!tombol || !ikon || !teks) {
                    return;
                }

                tombol.addEventListener('click', function () {
                    const temaSekarang = html.getAttribute('data-bs-theme');
                    const temaBaru = temaSekarang === 'dark' ? 'light' : 'dark';

                    html.setAttribute('data-bs-theme', temaBaru);

                    if (temaBaru === 'dark') {
                        ikon.className = 'bi bi-sun-fill';
                        teks.textContent = 'Mode Terang';
                    } else {
                        ikon.className = 'bi bi-moon-stars-fill';
                        teks.textContent = 'Mode Gelap';
                    }
                });
            });
        </script>
    @endpush

    @stack('scripts')

</body>
</html>
