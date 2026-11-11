{{--
    Nama file   : edit.blade.php (matakuliah)
    NIM         : 3202416144
    Nama        : Mar'atussholeha
--}}

@extends('layouts.app')

@section('title', 'Edit Mata Kuliah')

@section('content')

    <x-page-header
        judul="Edit Mata Kuliah"
        deskripsi="Perbarui informasi mata kuliah." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            <i class="bi bi-pencil-square me-2"></i>
            Form Edit Mata Kuliah
        </div>

        <div class="card-body">

            <form action="{{ route('matakuliah.update', $matakuliah->id) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="kode_mk" class="form-label">
                        Kode Mata Kuliah
                    </label>
                    <input type="text"
                        name="kode_mk"
                        id="kode_mk"
                        class="form-control @error('kode_mk') is-invalid @enderror"
                        value="{{ old('kode_mk', $matakuliah->kode_mk) }}"
                        maxlength="10"
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
                        value="{{ old('nama_mk', $matakuliah->nama_mk) }}"
                        maxlength="100"
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
                        value="{{ old('sks', $matakuliah->sks) }}"
                        min="1"
                        max="255"
                        required>

                    @error('sks')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Perbarui
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
