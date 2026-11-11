{{--
    Nama file   : _aksi.blade.php (krs)
    NIM         : 3202416144
    Nama        : Mar'atussholeha
--}}

<div class="d-flex justify-content-center gap-1">

    {{-- Detail --}}
    <a href="{{ route('krs.show', $krs->id) }}"
       class="btn btn-sm btn-info"
       title="Detail KRS">
        <i class="bi bi-eye"></i>
    </a>

    {{-- Edit --}}
    <a href="{{ route('krs.edit', $krs->id) }}"
       class="btn btn-sm btn-warning"
       title="Edit KRS">
        <i class="bi bi-pencil-square"></i>
    </a>

    {{-- Hapus --}}
    <button type="button"
        class="btn btn-sm btn-danger btn-hapus-krs"
        data-id="{{ $krs->id }}"
        data-nama="{{ $krs->mahasiswa->nama ?? 'Mahasiswa' }}"
        title="Hapus KRS">
        <i class="bi bi-trash"></i>
    </button>

</div>
