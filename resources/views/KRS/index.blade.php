{{--
    Nama file   : index.blade.php (krs)
    NIM         : 3202416144
    Nama        : Mar'atussholeha
--}}

@extends('layouts.app')

@section('title', 'Data KRS')

@section('content')

<x-page-header
    judul="Data KRS"
    deskripsi="Kelola Kartu Rencana Studi mahasiswa.">

    <a href="{{ route('krs.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah KRS
    </a>

</x-page-header>

{{-- ==========================================
     FILTER DATA KRS
========================================== --}}
<div class="card border-0 shadow-sm mb-3">

    <div class="card-header bg-body fw-semibold">
        <i class="bi bi-funnel-fill me-2"></i>
        Filter Data KRS
    </div>

    <div class="card-body">

        <div class="row g-3 align-items-end">

            {{-- Filter Tahun Akademik --}}
            <div class="col-md-4">
                <label for="filter-tahun" class="form-label fw-semibold">
                    Tahun Akademik
                </label>

                <select id="filter-tahun" class="form-select">
                    <option value="">Semua Tahun Akademik</option>

                    @foreach ($daftarTahun as $tahun)
                        <option value="{{ $tahun }}">
                            {{ $tahun }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- Filter Semester --}}
            <div class="col-md-4">
                <label for="filter-semester" class="form-label fw-semibold">
                    Semester
                </label>

                <select id="filter-semester" class="form-select">
                    <option value="">Semua Semester</option>
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>
                </select>
            </div>

            {{-- Tombol Filter --}}
            <div class="col-md-4">
                <button
                    type="button"
                    id="btn-filter"
                    class="btn btn-primary me-1">
                    <i class="bi bi-funnel"></i>
                    Terapkan Filter
                </button>

                <button
                    type="button"
                    id="btn-reset"
                    class="btn btn-secondary">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </button>
            </div>

        </div>

    </div>
</div>

{{-- ==========================================
     TABEL DATA KRS
========================================== --}}
<div class="card border-0 shadow-sm">

    <div class="card-header bg-body fw-semibold">
        <i class="bi bi-journal-bookmark me-2"></i>
        Daftar Kartu Rencana Studi
    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table id="tabel-krs"
                class="table table-striped table-hover table-bordered align-middle w-100">

                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Tahun Akademik</th>
                        <th>Semester</th>
                        <th>Jumlah MK</th>
                        <th>Total SKS</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody></tbody>

            </table>

        </div>

    </div>
</div>

@endsection

{{-- ==========================================
     SCRIPT DATATABLES DAN FILTER
========================================== --}}
@push('scripts')
<script>
$(document).ready(function () {

    // Inisialisasi DataTables.
    const tabelKrs = $('#tabel-krs').DataTable({

        processing: true,
        serverSide: true,

        // Mengirim pilihan filter ke controller.
        ajax: {
            url: @json(route('krs.data')),
            data: function (d) {
                d.tahun_akademik = $('#filter-tahun').val();
                d.semester = $('#filter-semester').val();
            }
        },

        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'nim',
                name: 'mahasiswa.nim'
            },
            {
                data: 'nama_mahasiswa',
                name: 'mahasiswa.nama'
            },
            {
                data: 'tahun_akademik',
                name: 'tahun_akademik'
            },
            {
                data: 'semester',
                name: 'semester'
            },
            {
                data: 'jumlah_mk',
                name: 'jumlah_mk',
                orderable: false,
                searchable: false
            },
            {
                data: 'jumlah_sks',
                name: 'jumlah_sks',
                orderable: false,
                searchable: false
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false
            }
        ],

        language: {
            processing: 'Sedang memproses...',
            search: 'Cari:',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
            infoEmpty: 'Tidak ada data yang tersedia',
            zeroRecords: 'Data tidak ditemukan',
            emptyTable: 'Belum ada data KRS',
            paginate: {
                first: 'Pertama',
                last: 'Terakhir',
                next: 'Berikutnya',
                previous: 'Sebelumnya'
            }
        }

    });

    // Tombol Terapkan Filter.
    $('#btn-filter').on('click', function () {
        tabelKrs.ajax.reload();
    });

    // Tombol Reset Filter.
    $('#btn-reset').on('click', function () {
        $('#filter-tahun').val('');
        $('#filter-semester').val('');

        tabelKrs.ajax.reload();
    });

});

// ==========================================
// SWEETALERT2 HAPUS DATA KRS
// ==========================================
$(document).on('click', '.btn-hapus-krs', function () {

    const id = $(this).data('id');
    const nama = $(this).data('nama');

    Swal.fire({
        title: 'Hapus KRS?',
        text: 'KRS milik ' + nama + ' akan dihapus.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: '{{ url('/krs') }}/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },

                success: function (response) {

                    Swal.fire(
                        'Berhasil!',
                        response.message,
                        'success'
                    );

                    $('#tabel-krs').DataTable()
                        .ajax.reload(null, false);
                },

                error: function (xhr) {

                    let pesan = xhr.responseJSON?.message
                        ?? 'Data KRS gagal dihapus.';

                    Swal.fire('Gagal!', pesan, 'error');
                }
            });

        }

    });

});
</script>
@endpush
