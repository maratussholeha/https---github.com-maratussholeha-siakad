<?php

/*
    Nama file : KrsSeeder.php
    NIM       : 3202416144
    Nama      : Mar'atussholeha
*/

namespace Database\Seeders;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Mata_Kuliah;
use Illuminate\Database\Seeder;
use RuntimeException;

class KrsSeeder extends Seeder
{
    public function run(): void
    {
        // Mengambil 10 mahasiswa pertama
        $mahasiswa = Mahasiswa::orderBy('id')
            ->limit(10)
            ->get();

        // Memastikan tersedia 10 mahasiswa
        if ($mahasiswa->count() < 10) {
            throw new RuntimeException(
                'Data mahasiswa harus tersedia minimal 10.'
            );
        }

        // Memastikan tersedia minimal 5 mata kuliah
        if (Mata_Kuliah::count() < 5) {
            throw new RuntimeException(
                'Data mata kuliah harus tersedia minimal 5.'
            );
        }

        foreach ($mahasiswa as $mhs) {

            // Membuat atau mengambil KRS mahasiswa
            $krs = Krs::firstOrCreate([
                'mahasiswa_id' => $mhs->id,
                'tahun_akademik' => '2026/2027',
                'semester' => 'Ganjil',
            ]);

            // Memilih 5 mata kuliah secara acak
            $mataKuliahIds = Mata_Kuliah::inRandomOrder()
                ->limit(5)
                ->pluck('id');

            // Menghindari detail ganda saat seeder dijalankan ulang
            $krs->mataKuliah()->detach();

            // Menghubungkan 5 mata kuliah dengan KRS
            $krs->mataKuliah()->attach($mataKuliahIds);
        }
    }
}
