<!DOCTYPE html>

{{--
    Nama file : app.blade.php
    NIM       : 3202416144
    Nama      : Mar'atussholeha
--}}

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
    <script
        src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"
    ></script>


    @stack('scripts')

</body>

</html>