
<?php

/*
    Nama file   : 2026_10_24_204750_fix_foreign_keys_for_krs_tables.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
*/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            $table->dropForeign('krs_mahasiswa_id_foreign');

            $table->foreign('mahasiswa_id')
                ->references('id')
                ->on('mahasiswa')
                ->cascadeOnDelete();
        });

        Schema::table('krs_detail', function (Blueprint $table) {
            $table->dropForeign('krs_detail_krs_id_foreign');

            $table->foreign('krs_id')
                ->references('id')
                ->on('krs')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('krs_detail', function (Blueprint $table) {
            $table->dropForeign('krs_detail_krs_id_foreign');

            $table->foreign('krs_id')
                ->references('id')
                ->on('krs');
        });

        Schema::table('krs', function (Blueprint $table) {
            $table->dropForeign('krs_mahasiswa_id_foreign');

            $table->foreign('mahasiswa_id')
                ->references('id')
                ->on('mahasiswa');
        });
    }
};
