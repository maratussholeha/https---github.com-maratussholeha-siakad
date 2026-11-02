<?php
/*
    Nama file   : 2026_10_21_112606_create_dosen_table.php
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
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
			$table->string('nidn', 10)->unique();
			$table->string('nama', 100);
			$table->string('email', 100)->unique();
			$table->string('telepon', 20)->nullable();
			$table->string('alamat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
