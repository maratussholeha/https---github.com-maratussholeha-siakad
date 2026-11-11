
{{--
    Nama file   : edit.blade.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
--}}

@extends('layouts.app')

@section('title', 'Edit KRS')

@section('content')

<div class="container-fluid">

    {{-- Header halaman --}}
    <x-page-header
        judul="Edit Kartu Rencana Studi"
        deskripsi="Ubah informasi dan mata kuliah KRS mahasiswa."
    />

    {{-- Card form edit --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-warning py-3">
            <h5 class="mb-0">
                <i class="bi bi-pencil-square me-2"></i>
                Form Edit KRS
            </h5>
        </div>

        <div class="card-body p-4">

            {{-- Memanggil form KRS --}}
            @include('krs._form')

        </div>

    </div>

</div>

@endsection
