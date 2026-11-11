{{--
    Nama file   : create.blade.php (matakuliah)
    NIM         : 3202416144
    Nama        : Mar'atussholeha
--}}

@extends('layouts.app')

@section('title', 'Tambah Mata Kuliah')

@section('content')

    <x-page-header
        judul="Tambah Mata Kuliah"
        deskripsi="Tambahkan data mata kuliah baru ke dalam sistem." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            <i class="bi bi-plus-circle me-2"></i>
            Form Tambah Mata Kuliah
        </div>

        <div class="card-body">

            <form action="{{ route('matakuliah.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="kode_mk" class="form-label">
                        Kode Mata Kuliah
                    </label>
                    <input type="text"
                        name="kode_mk"
                        id="kode_mk"
                        class="form-control @error('kode_mk') is-invalid @enderror"
                        value="{{ old('kode_mk') }}"
                        maxlength="10"
                        placeholder="Contoh: TIF201"
                        required>

                    @error('kode_mk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_mk" class="form-label">
                        Nama Mata Kuliah
                    </label>
                    <input type="text"
                        name="nama_mk"
                        id="nama_mk"
                        class="form-control @error('nama_mk') is-invalid @enderror"
                        value="{{ old('nama_mk') }}"
                        maxlength="100"
                        placeholder="Masukkan nama mata kuliah"
                        required>

                    @error('nama_mk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sks" class="form-label">
                        Jumlah SKS
                    </label>
                    <input type="number"
                        name="sks"
                        id="sks"
                        class="form-control @error('sks') is-invalid @enderror"
                        value="{{ old('sks') }}"
                        min="1"
                        max="255"
                        placeholder="Contoh: 3"
                        required>

                    @error('sks')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>

                    <a href="{{ route('matakuliah.index') }}"
                        class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

@endsection
