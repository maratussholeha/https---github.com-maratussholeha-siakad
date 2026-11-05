<!DOCTYPE html>

{{--
    Nama file : app.blade.php
    NIM       : 3202416144
    Nama      : Mar'atussholeha
--}}

<html lang="id" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title', 'SIAKAD') | {{ config('app.name') }}
    </title>

    {{-- Bootstrap CSS --}}
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">

    {{-- SweetAlert2 CSS --}}
    <link href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">

    {{-- CSS SIAKAD --}}
    <link href="{{ asset('css/siakad.css') }}" rel="stylesheet">

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

    {{-- SweetAlert2 JavaScript --}}
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

    {{-- NOTIFIKASI SWEETALERT2 --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // POPUP BERHASIL LOGIN
            @if (session()->has('login_success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Anda Berhasil Login!',
                    text: @json(session('login_success')),
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#6558c9',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                });
            @endif

            // KONFIGURASI TOAST
            const Toast = Swal.mixin({
                toast: true,
                position: 'center',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            // NOTIFIKASI BERHASIL
            @if (session()->has('success'))
                Toast.fire({
                    icon: 'success',
                    title: @json(session('success'))
                });
            @endif

            // NOTIFIKASI GAGAL
            @if (session()->has('error'))
                Toast.fire({
                    icon: 'error',
                    title: @json(session('error'))
                });
            @endif

            // NOTIFIKASI PERINGATAN
            @if (session()->has('warning'))
                Toast.fire({
                    icon: 'warning',
                    title: @json(session('warning'))
                });
            @endif

            // NOTIFIKASI INFORMASI
            @if (session()->has('info'))
                Toast.fire({
                    icon: 'info',
                    title: @json(session('info'))
                });
            @endif

        });
    </script>

    {{-- JAVASCRIPT TEMA TERANG DAN GELAP --}}
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

                const temaBaru = temaSekarang === 'dark'
                    ? 'light'
                    : 'dark';

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

    {{-- SCRIPT TAMBAHAN DARI HALAMAN LAIN --}}
    @stack('scripts')
	
</body>
</html>