<?php
/*
    Nama file   : DatabaseSeeder.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
*/

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
		$this->call([
			AdminSeeder::class,
			UserSeeder::class,
			DosenSeeder::class,
			MahasiswaSeeder::class,
			MataKuliahSeeder::class,
			KrsSeeder::class,
		]);
    }
}
