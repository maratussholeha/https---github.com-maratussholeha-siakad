{{-- 
    Nama file : edit.blade.php
    NIM       : 3202416144
    Nama      : Mar'atussholeha
--}}

@extends('layouts.app')

@section('title', 'Ubah Mahasiswa')

@section('content')
    <x-page-header
        judul="Ubah Mahasiswa"
        deskripsi="Perbarui informasi data mahasiswa."
    />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body">
            <span class="fw-semibold">Form Ubah Mahasiswa</span>
        </div>

        <div class="card-body">
            <form action="{{ route('mahasiswa.update', $mahasiswa) }}" method="POST">
                @csrf
                @method('PUT')

                @include('mahasiswa._form')

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Perbarui
                    </button>

                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
