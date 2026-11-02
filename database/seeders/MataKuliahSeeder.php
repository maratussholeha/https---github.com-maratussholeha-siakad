<?php
/*
    Nama file   : MataKuliahSeeder.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
*/

namespace Database\Seeders;

use App\Models\Mata_Kuliah as MataKuliah;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        $daftar = [
            ['TI101', 'Pengantar Teknologi Informasi', 2],
            ['TI102', 'Algoritma dan Pemrograman', 3],
            ['TI103', 'Matematika Diskrit', 3],
            ['TI201', 'Basis Data', 3],
            ['TI202', 'Desain Web', 3],
            ['TI203', 'Pemrograman Web', 3],
            ['TI204', 'Jaringan Komputer', 3],
            ['TI301', 'Rekayasa Perangkat Lunak', 3],
            ['TI302', 'Pemrograman Berorientasi Objek', 3],
            ['TI303', 'Sistem Operasi', 2],
        ];

        foreach ($daftar as [$kode, $nama, $sks]) {
            MataKuliah::updateOrCreate(
                ['kode_mk' => $kode],
                ['nama_mk' => $nama, 'sks' => $sks]
            );
        }
    }

}
