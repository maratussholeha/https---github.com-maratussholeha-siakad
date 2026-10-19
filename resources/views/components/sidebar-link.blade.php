@props(['route', 'ikon', 'pola' => null])

{{--Nama file   : sidebar-link.blade.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha   --}}

@php
    $aktif = request()->routeIs($pola ?? $route);
@endphp

<li class="nav-item">
    <a href="{{ route($route) }}"
        class="nav-link d-flex align-items-center gap-2 {{ $aktif ? 'active' : '' }}"
        @if ($aktif) aria-current="page" @endif>
        <i class="bi {{ $ikon }}"></i>
        <span>{{ $slot }}</span>
    </a>
</li>