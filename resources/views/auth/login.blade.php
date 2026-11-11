{{--
    Nama file : login.blade.php
    NIM       : 3202416144
    Nama      : Mar'atussholeha
--}}

@extends('layouts.guest')

@section('title', 'Login')

{{-- CSS HALAMAN LOGIN --}}
@push('styles')
<style>
    /* Menghilangkan ikon password bawaan browser */
    input::-ms-reveal,
    input::-ms-clear {
        display: none;
    }

    input::-webkit-credentials-auto-fill-button {
        visibility: hidden;
        display: none !important;
        pointer-events: none;
    }

    /* HEADER LOGIN */
    .login-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 8px;
    }

    /* UKURAN IKON TOPI WISUDA */
    .login-logo i {
        font-size: 72px;
        color: var(--bs-primary);
        line-height: 1;
    }

    /* TOMBOL TAMPILKAN PASSWORD */
    .password-toggle {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 44px;
    }

    .password-toggle svg {
        display: block;
    }
</style>
@endpush

@section('content')

    {{-- HEADER LOGIN --}}
    <div class="text-center mb-4">

        {{-- IKON TOPI WISUDA --}}
        <div class="login-logo">
            <i class="bi bi-mortarboard-fill"></i>
        </div>

        {{-- NAMA APLIKASI --}}
        <h1 class="h3 fw-bold mb-1">
            {{ config('app.name') }}
        </h1>

        {{-- NAMA KAMPUS --}}
        <p class="text-body-secondary mb-0">
            Politeknik Negeri Pontianak
        </p>

    </div>

    {{-- NOTIFIKASI --}}
    @include('layouts.partials.flash')

    {{-- CARD LOGIN --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <h2 class="h5 mb-3">
                Masuk ke akun Anda
            </h2>

            <form method="POST"
                  action="{{ route('login.attempt') }}"
                  novalidate>

                @csrf

                {{-- EMAIL --}}
                <div class="mb-3">

                    <x-form-input
                        label="Email"
                        name="email"
                        type="email"
                        autocomplete="username"
                        required
                        autofocus
                    />

                </div>

                {{-- PASSWORD --}}
                <div class="mb-3">

                    <label for="password" class="form-label">
                        Kata Sandi
                    </label>

                    <div class="input-group">

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            autocomplete="current-password"
                            required
                        >

                        {{-- TOMBOL LIHAT PASSWORD --}}
                        <button
                            class="btn btn-outline-secondary password-toggle"
                            type="button"
                            id="togglePassword"
                            aria-label="Tampilkan kata sandi"
                        >

                            {{-- IKON MATA --}}
                            <svg
                                id="iconEye"
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>

                        </button>

                    </div>

                    {{-- ERROR PASSWORD --}}
                    @error('password')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- INGAT SAYA --}}
                <div class="form-check mb-3">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="remember"
                        id="remember"
                        value="1"
                    >

                    <label class="form-check-label" for="remember">
                        Ingat saya
                    </label>

                </div>

                {{-- TOMBOL MASUK --}}
                <button
                    type="submit"
                    class="btn btn-primary w-100"
                >
                    Masuk
                </button>

            </form>

        </div>
    </div>

@endsection

{{-- JAVASCRIPT TAMPILKAN / SEMBUNYIKAN PASSWORD --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const password = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const iconEye = document.getElementById('iconEye');

        if (!password || !togglePassword || !iconEye) {
            return;
        }

        togglePassword.addEventListener('click', function () {

            if (password.type === 'password') {

                // Tampilkan password
                password.type = 'text';

                // Ubah menjadi ikon mata dicoret
                iconEye.innerHTML = `
                    <path d="M3 3l18 18"/>
                    <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                    <path d="M9.9 5.2A10.5 10.5 0 0 1 12 5c6.4 0 10 7 10 7a13.5 13.5 0 0 1-3 3.8"/>
                    <path d="M6.2 6.2C3.5 8 2 12 2 12s3.6 7 10 7a10.5 10.5 0 0 0 4-.8"/>
                `;

                togglePassword.setAttribute(
                    'aria-label',
                    'Sembunyikan kata sandi'
                );

            } else {

                // Sembunyikan password
                password.type = 'password';

                // Kembalikan ikon mata biasa
                iconEye.innerHTML = `
                    <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12z"/>
                    <circle cx="12" cy="12" r="3"/>
                `;

                togglePassword.setAttribute(
                    'aria-label',
                    'Tampilkan kata sandi'
                );

            }

        });

    });
</script>
@endpush
