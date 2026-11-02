{{-- 
    Nama file : show.blade.php
    NIM        : 3202416144
    Nama       : Mar'atussholeha
--}}

@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
    <x-page-header
        judul="Detail Mahasiswa"
        deskripsi="Informasi lengkap mahasiswa."
    />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            Data Detail Mahasiswa
        </div>

        <div class="card-body">
            <h5 class="card-title mb-3">
                {{ $mahasiswa['nama'] }}
            </h5>

            <p class="mb-2">
                <strong>NIM:</strong>
                {{ $mahasiswa['nim'] }}
            </p>

            <p class="mb-2">
                <strong>Angkatan:</strong>
                {{ $mahasiswa['angkatan'] }}
            </p>

            <p class="mb-2">
                <strong>Email:</strong>
                {{ $mahasiswa['email'] }}
            </p>

            <p class="mb-3">
                <strong>Status:</strong>

                @php
                    $warna = match ($mahasiswa['status']) {
                        'Aktif' => 'success',
                        'Cuti' => 'warning',
                        'Lulus' => 'secondary',
                        default => 'secondary',
                    };
                @endphp

                <span class="badge text-bg-{{ $warna }}">
                    {{ $mahasiswa['status'] }}
                </span>
            </p>

            <a href="{{ route('mahasiswa.index') }}"
               class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>
@endsection
