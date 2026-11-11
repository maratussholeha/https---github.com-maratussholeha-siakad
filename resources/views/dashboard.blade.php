{{--
    Nama file   : dashboard.blade.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
--}}

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <x-page-header
        judul="Dashboard"
        deskripsi="Ringkasan data akademik berdasarkan database SIAKAD."
    />

    {{-- Kartu Statistik --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5 g-3 mb-4">

        @foreach ($statistik as $item)
            <div class="col">
                <x-stat-card
                    :judul="$item['judul']"
                    :jumlah="$item['jumlah']"
                    :ikon="$item['ikon']"
                    :warna="$item['warna']"
                />
            </div>
        @endforeach

    </div>

    {{-- KRS Terbaru dan Status KRS --}}
    <div class="row g-3">

        {{-- Tabel KRS Terbaru --}}
        <div class="col-12 col-xl-8">
            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-body fw-semibold">
                    <i class="bi bi-clock-history me-2"></i>
                    KRS Terbaru
                </div>

                <div class="card-body p-0">
                    <x-table
                        :kolom="$kolomKrs"
                        :baris="$krsTerbaru"
                    />
                </div>

            </div>
        </div>

        {{-- Status KRS --}}
        <div class="col-12 col-xl-4">
            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-body fw-semibold">
                    <i class="bi bi-pie-chart-fill me-2"></i>
                    Status KRS
                </div>

                <div class="card-body">

                    @forelse ($statusKrs as $s)
                        <div class="mb-3">

                            <div class="d-flex justify-content-between small mb-1">
                                <span>{{ $s['label'] }}</span>
                                <span>{{ $s['persen'] }}%</span>
                            </div>

                            <div
                                class="progress"
                                role="progressbar"
                                aria-valuenow="{{ $s['persen'] }}"
                                aria-valuemin="0"
                                aria-valuemax="100"
                            >
                                <div
                                    class="progress-bar bg-{{ $s['warna'] }}"
                                    style="width: {{ $s['persen'] }}%"
                                ></div>
                            </div>

                        </div>
                    @empty
                        <p class="text-muted text-center mb-0">
                            Belum ada data KRS.
                        </p>
                    @endforelse

                </div>
            </div>
        </div>

    </div>

@endsection
