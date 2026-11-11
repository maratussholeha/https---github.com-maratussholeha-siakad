{{-- 
    Nama file : show.blade.php
    NIM       : 3202416144
    Nama      : Mar'atussholeha
--}}

@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
    <x-page-header
        judul="Detail Mahasiswa"
        deskripsi="Informasi lengkap data mahasiswa."
    />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body">
            <span class="fw-semibold">Informasi Mahasiswa</span>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <tr>
                        <th width="25%">NIM</th>
                        <td>{{ $mahasiswa->nim }}</td>
                    </tr>

                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $mahasiswa->nama }}</td>
                    </tr>

                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>
                            @if ($mahasiswa->jenis_kelamin === 'L')
                                Laki-laki
                            @elseif ($mahasiswa->jenis_kelamin === 'P')
                                Perempuan
                            @else
                                {{ $mahasiswa->jenis_kelamin }}
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ $mahasiswa->email }}</td>
                    </tr>

                    <tr>
                        <th>Angkatan</th>
                        <td>{{ $mahasiswa->angkatan }}</td>
                    </tr>

                    <tr>
                        <th>Program Studi</th>
                        <td>{{ $mahasiswa->program_studi }}</td>
                    </tr>
                </table>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('mahasiswa.index') }}"
                   class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('mahasiswa.edit', $mahasiswa) }}"
                       class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Ubah Data
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
