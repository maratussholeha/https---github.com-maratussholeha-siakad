@extends('layouts.app')

{{--Nama file   : index.blade.php (dosen)
    NIM         : 3202416144
    Nama        : Mar'atussholeha   --}}

@section('title', 'Data Dosen')

@section('content')
    <x-page-header
        judul="Data Dosen"
        deskripsi="Daftar dosen pengampu (data contoh)." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            Daftar Dosen
        </div>

        <div class="card-body p-0">
            <x-table :kolom="$kolom" :baris="$dosen" />
        </div>
    </div>
@endsection