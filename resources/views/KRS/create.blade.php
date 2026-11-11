{{--
    Nama file   : create.blade.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
--}}

@extends('layouts.app')

@section('title', 'Tambah KRS')

@section('content')

<div class="container-fluid">

    {{-- Header halaman --}}
    <x-page-header
        judul="Tambah Kartu Rencana Studi"
        deskripsi="Form untuk menambahkan data KRS mahasiswa."
    />

    {{-- Card form --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">
                <i class="bi bi-plus-circle me-2"></i>
                Form Tambah KRS
            </h5>
        </div>

        <div class="card-body p-4">

            {{-- Memanggil form KRS --}}
            @include('krs._form')

        </div>

    </div>

</div>

@endsection
