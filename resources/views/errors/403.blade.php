{{--
    Nama file : 403.blade.php
    NIM       : 3202416144
    Nama      : Mar'atussholeha
--}}
@extends('layouts.app')

@section('title', 'Akses Ditolak')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-5">

                    {{-- IKON PERINGATAN --}}
                    <div class="mb-4">
                        <i class="bi bi-shield-lock-fill text-danger"
                           style="font-size: 5rem;">
                        </i>
                    </div>

                    {{-- KODE ERROR --}}
                    <h1 class="display-1 fw-bold text-danger">
                        403
                    </h1>

                    {{-- JUDUL --}}
                    <h2 class="h4 fw-bold mb-3">
                        Akses Ditolak!
                    </h2>

                    {{-- PESAN --}}
                    <p class="text-body-secondary mb-4">
                        Maaf, Anda tidak memiliki izin untuk
                        mengakses halaman ini.
                        Silakan kembali ke dashboard.
                    </p>

                    {{-- TOMBOL KEMBALI --}}
                    <a href="{{ route('dashboard') }}"
                       class="btn btn-primary px-4">

                        <i class="bi bi-house-door-fill me-2"></i>
                        Kembali ke Dashboard

                    </a>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
