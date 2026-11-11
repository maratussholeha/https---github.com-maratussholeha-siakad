{{--
    Nama file   : statistik.blade.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
--}}

@extends('layouts.app')

@section('title', 'Dashboard Statistik')

@section('content')

<div class="container-fluid">

    <x-page-header
        judul="Dashboard Statistik"
        deskripsi="Informasi jumlah data pada Sistem Informasi Akademik."
    />

    <div class="row g-4">

        {{-- Total Mahasiswa --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-2">
                                Total Mahasiswa
                            </p>

                            <h2 class="fw-bold text-primary mb-0">
                                {{ number_format($jumlahMahasiswa) }}
                            </h2>
                        </div>

                        <div class="bg-primary bg-opacity-10 rounded p-3">
                            <i class="bi bi-people-fill text-primary fs-2"></i>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        {{-- Total Mata Kuliah --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-2">
                                Total Mata Kuliah
                            </p>

                            <h2 class="fw-bold text-success mb-0">
                                {{ number_format($jumlahMataKuliah) }}
                            </h2>
                        </div>

                        <div class="bg-success bg-opacity-10 rounded p-3">
                            <i class="bi bi-book-fill text-success fs-2"></i>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        {{-- Total KRS --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-2">
                                Total KRS
                            </p>

                            <h2 class="fw-bold text-warning mb-0">
                                {{ number_format($jumlahKrs) }}
                            </h2>
                        </div>

                        <div class="bg-warning bg-opacity-10 rounded p-3">
                            <i class="bi bi-clipboard-check-fill text-warning fs-2"></i>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="card shadow-sm border-0 mt-4">
        <div class="card-body">
            <h5 class="fw-bold mb-2">
                <i class="bi bi-info-circle text-primary me-2"></i>
                Informasi Dashboard
            </h5>

            <p class="text-muted mb-0">
                Data statistik ditampilkan berdasarkan jumlah
                data yang tersimpan di database SIAKAD.
                Angka akan diperbarui secara otomatis ketika
                data mahasiswa, mata kuliah, atau KRS berubah.
            </p>
        </div>
    </div>

</div>

@endsection
