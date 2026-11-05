{{--
    Nama file : flash.blade.php
    Nama      : Mar'atussholeha
    NIM       : 3202416144
--}}

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        @foreach (['success', 'error', 'warning', 'info'] as $pesan)
            @if (session($pesan))
                Toast.fire({
                    icon: @json($pesan),
                    title: @json(session($pesan))
                });
            @endif
        @endforeach

    });
</script>
@endpush
