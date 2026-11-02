{{-- 
    Nama file : index.blade.php
    NIM       : 3202416144
    Nama      : Mar'atussholeha
--}}

@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
    {{-- Header halaman dan tombol tambah mahasiswa --}}
    <x-page-header
        judul="Data Mahasiswa"
        deskripsi="Daftar mahasiswa (data contoh)."
    >
        <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="collapse"
            data-bs-target="#formMahasiswa"
        >
            <i class="bi bi-plus-lg"></i>
            Tambah Mahasiswa
        </button>
    </x-page-header>

    {{-- Form tambah mahasiswa yang dapat dibuka dan ditutup --}}
    <div class="collapse mb-4" id="formMahasiswa">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-body fw-semibold">
                Form Mahasiswa
            </div>

            <div class="card-body">
                @include('mahasiswa._form')
            </div>
        </div>
    </div>

    {{-- Tabel daftar mahasiswa --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            Daftar Mahasiswa
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Angkatan</th>
                            <th>Email</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($mahasiswa as $item)
                            <tr>
                                {{-- Nomor urut mahasiswa --}}
                                <td>{{ $loop->iteration }}</td>

                                {{-- NIM ditampilkan sebagai teks, tanpa route detail --}}
                                <td>{{ $item['nim'] }}</td>

                                {{-- Informasi mahasiswa --}}
                                <td>{{ $item['nama'] }}</td>
                                <td>{{ $item['angkatan'] }}</td>
                                <td>{{ $item['email'] }}</td>

                                {{-- Warna badge berdasarkan status mahasiswa --}}
                                <td>
                                    @php
                                        $warna = match ($item['status']) {
                                            'Aktif' => 'success',
                                            'Cuti' => 'warning',
                                            'Lulus' => 'secondary',
                                            default => 'secondary',
                                        };
                                    @endphp

                                    <span class="badge text-bg-{{ $warna }}">
                                        {{ $item['status'] }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            {{-- Pesan jika belum ada data mahasiswa --}}
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    Belum ada data mahasiswa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
