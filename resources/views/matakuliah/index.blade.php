{{--
    Nama file   : index.blade.php (matakuliah)
    NIM         : 3202416144
    Nama        : Mar'atussholeha
--}}

@extends('layouts.app')

@section('title', 'Data Mata Kuliah')

@section('content')

    <x-page-header
        judul="Data Mata Kuliah"
        deskripsi="Kelola data mata kuliah yang tersimpan di dalam sistem.">

        <a href="{{ route('matakuliah.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Mata Kuliah
        </a>

    </x-page-header>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-body fw-semibold">
            <i class="bi bi-book me-2"></i>
            Daftar Mata Kuliah
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table id="tabel-matakuliah"
                    class="table table-striped table-hover table-bordered align-middle w-100">

                    <thead class="table-primary">
                        <tr>
                            <th width="5%">No</th>
                            <th>Kode Mata Kuliah</th>
                            <th>Nama Mata Kuliah</th>
                            <th width="10%">SKS</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

@endsection

@push('scripts')

<script>
    $(document).ready(function () {

        const tabel = $('#tabel-matakuliah').DataTable({
            processing: true,
            serverSide: true,
            ajax: @json(route('matakuliah.data')),

            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'kode_mk',
                    name: 'kode_mk'
                },
                {
                    data: 'nama_mk',
                    name: 'nama_mk'
                },
                {
                    data: 'sks',
                    name: 'sks'
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
                emptyTable: 'Belum ada data mata kuliah',
                paginate: {
                    first: 'Pertama',
                    last: 'Terakhir',
                    next: 'Berikutnya',
                    previous: 'Sebelumnya'
                }
            }
        });
		
		// Menghapus data mata kuliah
        $(document).on('click', '.btn-hapus-matakuliah', function () {

            const id = $(this).data('id');
            const nama = $(this).data('nama');

            Swal.fire({
                title: 'Hapus Mata Kuliah?',
                text: 'Data "' + nama + '" akan dihapus.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: '{{ url('/matakuliah') }}/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },

                        success: function (response) {

                            tabel.ajax.reload(null, false);

                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success'
                            });

                        },

                        error: function (xhr) {

                            const pesan = xhr.responseJSON?.message
                                || 'Data mata kuliah gagal dihapus.';

                            Swal.fire({
                                title: 'Gagal!',
                                text: pesan,
                                icon: 'error'
                            });

                        }
                    });

                }

            });

        });


    });
</script>
@endpush
