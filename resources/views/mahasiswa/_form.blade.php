{{-- 
    Nama file : _form.blade.php
    NIM       : 3202416144
    Nama      : Mar'atussholeha
--}}

<div class="row g-3">

    <div class="col-md-4">
        <x-form-input
            label="NIM"
            name="nim"
            :value="$mahasiswa->nim"
            required
        />
    </div>

    <div class="col-md-8">
        <x-form-input
            label="Nama Lengkap"
            name="nama"
            :value="$mahasiswa->nama"
            required
        />
    </div>

    <div class="col-md-6">
        <label for="jenis_kelamin" class="form-label">
            Jenis Kelamin
        </label>

        <select
            id="jenis_kelamin"
            name="jenis_kelamin"
            class="form-select @error('jenis_kelamin') is-invalid @enderror"
            required
        >
            <option value="">-- Pilih Jenis Kelamin --</option>

            <option value="L" @selected(old('jenis_kelamin', $mahasiswa->jenis_kelamin) == 'L')>
                Laki-laki
            </option>

            <option value="P" @selected(old('jenis_kelamin', $mahasiswa->jenis_kelamin) == 'P')>
                Perempuan
            </option>
        </select>

        @error('jenis_kelamin')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <x-form-input
            label="Email"
            name="email"
            type="email"
            :value="$mahasiswa->email"
            required
        />
    </div>

    <div class="col-md-4">
        <x-form-input
            label="Angkatan"
            name="angkatan"
            type="number"
            :value="$mahasiswa->angkatan"
            required
        />
    </div>

    <div class="col-md-8">
        <x-form-input
            label="Program Studi"
            name="program_studi"
            :value="$mahasiswa->program_studi"
            required
        />
    </div>

</div>
