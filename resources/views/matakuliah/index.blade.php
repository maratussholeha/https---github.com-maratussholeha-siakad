{{--Nama file   : index.blade.php (matakuliah)
    NIM         : 3202416144
    Nama        : Mar'atussholeha   --}}
	
@extends('layouts.app')

@section('title', 'Data Mata Kuliah')

@section('content')
    <x-page-header
        judul="Data Mata Kuliah"
        deskripsi="Daftar mata kuliah (data contoh)." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            Daftar Mata Kuliah
        </div>

        <div class="card-body p-0">
            <x-table :kolom="$kolom" :baris="$matakuliah" />
        </div>
    </div>
@endsection