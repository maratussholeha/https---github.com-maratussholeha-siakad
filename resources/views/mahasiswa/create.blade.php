{{-- 
    Nama file : create.blade.php
    NIM       : 3202416144
    Nama      : Mar'atussholeha
--}}

@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
    <x-page-header
        judul="Tambah Mahasiswa"
        deskripsi="Tambahkan data mahasiswa baru ke dalam sistem."
    />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body">
            <span class="fw-semibold">Form Tambah Mahasiswa</span>
        </div>

        <div class="card-body">
            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf

                @include('mahasiswa._form')

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>

                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
