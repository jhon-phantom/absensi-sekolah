<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement("
        ALTER TABLE absensi_guru 
        MODIFY status ENUM(
            'mengajar',
            'piket_tepat_waktu',
            'piket_terlambat',
            'izin',
            'sakit',
            'alpha'
        ) NOT NULL
    ");
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
