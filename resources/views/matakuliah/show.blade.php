{{--
    Nama file   : show.blade.php (matakuliah)
    NIM         : 3202416144
    Nama        : Mar'atussholeha
--}}

@extends('layouts.app')

@section('title', 'Detail Mata Kuliah')

@section('content')

    <x-page-header
        judul="Detail Mata Kuliah"
        deskripsi="Informasi lengkap mata kuliah." />

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-body fw-semibold">
            <i class="bi bi-book me-2"></i>
            Informasi Mata Kuliah
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered align-middle">

                    <tr>
                        <th width="30%">Kode Mata Kuliah</th>
                        <td>{{ $matakuliah->kode_mk }}</td>
                    </tr>

                    <tr>
                        <th>Nama Mata Kuliah</th>
                        <td>{{ $matakuliah->nama_mk }}</td>
                    </tr>

                    <tr>
                        <th>Jumlah SKS</th>
                        <td>{{ $matakuliah->sks }} SKS</td>
                    </tr>

                </table>
            </div>

            <div class="d-flex gap-2">

                <a href="{{ route('matakuliah.index') }}"
                    class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>

                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('matakuliah.edit', $matakuliah->id) }}"
                        class="btn btn-warning">
                        <i class="bi bi-pencil-square me-1"></i> Edit
                    </a>
                @endif

            </div>

        </div>
    </div>

@endsection
