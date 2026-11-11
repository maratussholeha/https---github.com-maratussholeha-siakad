{{--
    Nama file   : _aksi.blade.php (matakuliah)
    NIM         : 3202416144
    Nama        : Mar'atussholeha
--}}

<div class="d-flex justify-content-center gap-1">

    {{-- Tombol Detail --}}
    <a href="{{ route('matakuliah.show', $matakuliah->id) }}"
        class="btn btn-sm btn-info text-white"
        title="Detail Mata Kuliah">
        <i class="bi bi-eye"></i>
    </a>

    {{-- Tombol Edit (Khusus Admin) --}}
    @if (auth()->user()->role === 'admin')
        <a href="{{ route('matakuliah.edit', $matakuliah->id) }}"
            class="btn btn-sm btn-warning"
            title="Edit Mata Kuliah">
            <i class="bi bi-pencil-square"></i>
        </a>

        {{-- Tombol Hapus --}}
        <button type="button"
            class="btn btn-sm btn-danger btn-hapus-matakuliah"
            data-id="{{ $matakuliah->id }}"
            data-nama="{{ $matakuliah->nama_mk }}"
            title="Hapus Mata Kuliah">
            <i class="bi bi-trash"></i>
        </button>
    @endif

</div>
