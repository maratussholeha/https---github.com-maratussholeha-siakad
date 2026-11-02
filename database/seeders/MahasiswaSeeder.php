<?php
/*
    Nama file   : MahasiswaSeeder.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
*/

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		Mahasiswa::factory()->count(50)->create();
        //
    }
}
