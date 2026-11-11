{{--
    Nama file   : _form.blade.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
--}}

@php
    $isEdit = isset($kr);

    $mataKuliahTerpilih = old(
        'mata_kuliah',
        $isEdit ? $kr->mataKuliah->pluck('id')->toArray() : []
    );
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan!</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form
    action="{{ $isEdit ? route('krs.update', $kr->id) : route('krs.store') }}"
    method="POST">

    @csrf

    @if ($isEdit)
        @method('PUT')
    @endif

    {{-- Mahasiswa --}}
    <div class="mb-3">
        <label class="form-label fw-semibold">
            Mahasiswa <span class="text-danger">*</span>
        </label>

        <select name="mahasiswa_id"
            class="form-select @error('mahasiswa_id') is-invalid @enderror"
            required>

            <option value="">-- Pilih Mahasiswa --</option>

            @foreach ($mahasiswa as $mhs)
                <option value="{{ $mhs->id }}"
                    @selected(old('mahasiswa_id', $isEdit ? $kr->mahasiswa_id : '') == $mhs->id)>

                    {{ $mhs->nim }} - {{ $mhs->nama }}

                </option>
            @endforeach

        </select>

        @error('mahasiswa_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Tahun Akademik --}}
    <div class="mb-3">
        <label class="form-label fw-semibold">
            Tahun Akademik <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="tahun_akademik"
            class="form-control @error('tahun_akademik') is-invalid @enderror"
            placeholder="Contoh: 2026/2027"
            value="{{ old('tahun_akademik', $isEdit ? $kr->tahun_akademik : '2026/2027') }}"
            pattern="[0-9]{4}/[0-9]{4}"
            required>

        @error('tahun_akademik')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Semester --}}
    <div class="mb-3">
        <label class="form-label fw-semibold">
            Semester <span class="text-danger">*</span>
        </label>

        <select name="semester" class="form-select" required>
            <option value="">-- Pilih Semester --</option>

            @foreach (['Ganjil', 'Genap'] as $semester)
                <option value="{{ $semester }}"
                    @selected(old('semester', $isEdit ? $kr->semester : '') == $semester)>
                    {{ $semester }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Status --}}
    <div class="mb-3">
        <label class="form-label fw-semibold">
            Status KRS <span class="text-danger">*</span>
        </label>

        <select name="status" class="form-select" required>

            @foreach ([
                'draft' => 'Draft',
                'diajukan' => 'Diajukan',
                'disetejui' => 'Disetujui',
                'ditolak' => 'Ditolak'
            ] as $value => $label)

                <option value="{{ $value }}"
                    @selected(old('status', $isEdit ? $kr->status : 'draft') == $value)>
                    {{ $label }}
                </option>

            @endforeach

        </select>
    </div>

    <hr>

    {{-- Mata Kuliah --}}
    <div class="mb-3">
        <label class="form-label fw-semibold">
            Pilih Mata Kuliah <span class="text-danger">*</span>
        </label>

        <p class="text-muted small">
            Centang satu atau lebih mata kuliah yang akan dimasukkan ke KRS.
        </p>

        <div class="border rounded p-3">

            @forelse ($mataKuliah as $mk)

                <div class="form-check mb-3">

                    <input
                        type="checkbox"
                        name="mata_kuliah[]"
                        value="{{ $mk->id }}"
                        class="form-check-input"
                        id="mk{{ $mk->id }}"
                        @checked(in_array($mk->id, $mataKuliahTerpilih))
                    >

                    <label class="form-check-label" for="mk{{ $mk->id }}">

                        <strong>{{ $mk->kode_mk }}</strong>
                        -
                        {{ $mk->nama_mk }}

                        <span class="badge bg-primary">
                            {{ $mk->sks }} SKS
                        </span>

                    </label>

                </div>

            @empty

                <div class="text-center text-muted">
                    Belum ada data mata kuliah.
                </div>

            @endforelse

        </div>

        @error('mata_kuliah')
            <div class="text-danger small mt-2">{{ $message }}</div>
        @enderror
    </div>

    <hr>

    {{-- Tombol --}}
    <div class="d-flex gap-2">

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i>
            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan KRS' }}
        </button>

        <a href="{{ route('krs.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>

    </div>

</form>
