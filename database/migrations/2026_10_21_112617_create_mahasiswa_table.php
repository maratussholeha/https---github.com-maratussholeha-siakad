<?php
/*
    Nama file   : 2026_10_21_112617_create_mahasiswa_table.php
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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
			$table->string('nim', 15)->unique();
			$table->string('nama', 100);
			$table->enum('jenis_kelamin', ['L', 'P']);
			$table->string('email', 100)->unique();
			$table->unsignedSmallInteger('angkatan');
			$table->string('program_studi', 100)->default('D3 Teknik Informatika');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
