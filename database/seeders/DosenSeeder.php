<?php
/*
    Nama file   : DosenSeeder.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
*/

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		Dosen::factory()->count(10)->create();
        //
    }
}
