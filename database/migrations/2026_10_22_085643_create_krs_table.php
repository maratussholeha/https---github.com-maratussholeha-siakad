<?php
/*
    Nama file   : 2026_10_22_085643_create_krs_table.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
   
*/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('krs', function (Blueprint $table) {
            $table->id();
			$table->foreignId('mahasiswa_id')
				->constrained('mahasiswa')
				->cascadeOneDelete();
			$table->string('tahun_akademik', 9);
			$table->enum('semester', ['Ganjil', 'Genap']);
			$table->enum('status', ['draft', 'diajukan', 'disetejui', 'ditolak'])
				->default('draft');
			$table->timestamps();
			$table->unique(['mahasiswa_id', 'tahun_akademik', 'semester']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};
