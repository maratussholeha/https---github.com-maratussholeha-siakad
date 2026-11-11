<!DOCTYPE html>
{{--
    Nama file : guest.blade.php
    NIM       : 3202416144
    Nama      : Mar'atussholeha
--}}

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Masuk') | {{ config('app.name') }}</title>

    {{-- Bootstrap CSS --}}
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}"
          rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}"
          rel="stylesheet">

    {{-- CSS SIAKAD --}}
    <link href="{{ asset('css/siakad.css') }}"
          rel="stylesheet">

    {{-- CSS Tambahan dari Halaman --}}
    @stack('styles')
</head>

<body class="bg-body-tertiary">

    <main class="container min-vh-100 py-4
                 d-flex align-items-center justify-content-center">

        <div class="w-100" style="max-width: 420px;">
            @yield('content')
        </div>

    </main>

    {{-- SweetAlert2 --}}
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

    {{-- NOTIFIKASI LOGOUT BERHASIL --}}
    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Anda Berhasil Keluar!',
                text: @json(session('success')),
                confirmButtonText: 'OK',
                allowOutsideClick: false
            });
        </script>
    @endif

    {{-- NOTIFIKASI LOGIN GAGAL --}}
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal!',
                    text: 'Email atau kata sandi yang Anda masukkan tidak sesuai.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#6558c9',
                    allowOutsideClick: false
                });
            });
        </script>
    @endif

    {{-- JavaScript Tambahan dari Halaman --}}
    @stack('scripts')

</body>
</html>
