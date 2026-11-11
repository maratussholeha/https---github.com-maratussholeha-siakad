<?php
/*
    Nama file   : DashboardController.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
*/

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Mata_Kuliah;
use App\Models\Krs;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Mengambil seluruh data KRS beserta relasinya.
        $semuaKrs = Krs::with(['mahasiswa', 'mataKuliah'])
            ->latest()
            ->get();

        // Menghitung jumlah data dari database.
        $jumlahMahasiswa = Mahasiswa::count();
        $jumlahDosen = Dosen::count();
        $jumlahMataKuliah = Mata_Kuliah::count();
        $jumlahKrs = $semuaKrs->count();

        // KRS aktif adalah KRS yang belum ditolak.
        $jumlahKrsAktif = $semuaKrs->filter(function ($krs) {
            return strtolower($krs->status) !== 'ditolak';
        })->count();

        // Menghitung total SKS setiap KRS.
        $totalSks = $semuaKrs->sum(function ($krs) {
            return $krs->mataKuliah->sum('sks');
        });

        // Menghitung rata-rata SKS per KRS.
        $rataRataSks = $jumlahKrs > 0
            ? round($totalSks / $jumlahKrs, 1)
            : 0;

        // Data kartu statistik.
        $statistik = [
            [
                'judul' => 'Mahasiswa',
                'jumlah' => $jumlahMahasiswa,
                'ikon' => 'bi-mortarboard-fill',
                'warna' => 'primary',
            ],
            [
                'judul' => 'Dosen',
                'jumlah' => $jumlahDosen,
                'ikon' => 'bi-person-badge-fill',
                'warna' => 'success',
            ],
            [
                'judul' => 'Mata Kuliah',
                'jumlah' => $jumlahMataKuliah,
                'ikon' => 'bi-book-half',
                'warna' => 'warning',
            ],
            [
                'judul' => 'KRS Aktif',
                'jumlah' => $jumlahKrsAktif,
                'ikon' => 'bi-journal-check',
                'warna' => 'info',
            ],
            [
                'judul' => 'Rata-rata SKS per KRS',
                'jumlah' => $rataRataSks,
                'ikon' => 'bi-calculator-fill',
                'warna' => 'primary',
            ],
        ];

        // Menyiapkan lima data KRS terbaru.
        $krsTerbaru = $semuaKrs->take(5)->map(function ($krs) {
            return [
                'nim' => $krs->mahasiswa->nim ?? '-',
                'nama' => $krs->mahasiswa->nama ?? '-',
                'sks' => $krs->mataKuliah->sum('sks'),
                'status' => $this->labelStatus($krs->status),
            ];
        })->values()->all();

        // Kolom tabel KRS terbaru.
        $kolomKrs = [
            'nim' => 'NIM',
            'nama' => 'Nama Mahasiswa',
            'sks' => 'SKS',
            'status' => 'Status',
        ];

        // Menghitung jumlah KRS berdasarkan status.
        $statusDisetujui = $semuaKrs->filter(function ($krs) {
            return in_array(
                strtolower($krs->status),
                ['disetujui', 'disetejui']
            );
        })->count();

        $statusMenunggu = $semuaKrs->filter(function ($krs) {
            return in_array(
                strtolower($krs->status),
                ['draft', 'diajukan', 'menunggu']
            );
        })->count();

        $statusDitolak = $semuaKrs->filter(function ($krs) {
            return strtolower($krs->status) === 'ditolak';
        })->count();

        // Menghitung persentase status KRS.
        $statusKrs = [
            [
                'label' => 'Disetujui',
                'persen' => $jumlahKrs > 0
                    ? round(($statusDisetujui / $jumlahKrs) * 100)
                    : 0,
                'warna' => 'success',
            ],
            [
                'label' => 'Menunggu',
                'persen' => $jumlahKrs > 0
                    ? round(($statusMenunggu / $jumlahKrs) * 100)
                    : 0,
                'warna' => 'warning',
            ],
            [
                'label' => 'Ditolak',
                'persen' => $jumlahKrs > 0
                    ? round(($statusDitolak / $jumlahKrs) * 100)
                    : 0,
                'warna' => 'danger',
            ],
        ];

        return view('dashboard', compact(
            'statistik',
            'kolomKrs',
            'krsTerbaru',
            'statusKrs'
        ));
    }

    // Mengubah kode status menjadi tulisan yang mudah dibaca.
    private function labelStatus($status): string
    {
        return match (strtolower($status)) {
            'disetujui', 'disetejui' => 'Disetujui',
            'diajukan' => 'Menunggu',
            'draft' => 'Draft',
            'ditolak' => 'Ditolak',
            default => ucfirst($status),
        };
    }
}
