{{--
    Nama file   : show.blade.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
--}}

@extends('layouts.app')

@section('title', 'Detail KRS')

@section('content')

<div class="container-fluid">

    <x-page-header
        judul="Detail Kartu Rencana Studi"
        deskripsi="Informasi lengkap KRS mahasiswa."
    />

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            Informasi KRS
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <tr>
                    <th width="200">NIM</th>
                    <td>{{ $kr->mahasiswa->nim ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Nama Mahasiswa</th>
                    <td>{{ $kr->mahasiswa->nama ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Tahun Akademik</th>
                    <td>{{ $kr->tahun_akademik }}</td>
                </tr>

                <tr>
                    <th>Semester</th>
                    <td>{{ $kr->semester }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($kr->status) }}</td>
                </tr>

                <tr>
                    <th>Jumlah Mata Kuliah</th>
                    <td>{{ $kr->mataKuliah->count() }}</td>
                </tr>

                <tr>
                    <th>Total SKS</th>
                    <td>{{ $kr->mataKuliah->sum('sks') }}</td>
                </tr>
            </table>

            <h5 class="mt-4">Daftar Mata Kuliah</h5>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($kr->mataKuliah as $index => $mk)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $mk->kode_mk }}</td>
                                <td>{{ $mk->nama_mk }}</td>
                                <td>{{ $mk->sks }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    Belum ada mata kuliah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <a href="{{ route('krs.index') }}"
               class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

            <a href="{{ route('krs.edit', $kr->id) }}"
               class="btn btn-warning">
                <i class="bi bi-pencil-square"></i> Edit KRS
            </a>

        </div>
    </div>

</div>

@endsection
