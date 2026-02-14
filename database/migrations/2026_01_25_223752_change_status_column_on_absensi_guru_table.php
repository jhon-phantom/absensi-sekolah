<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('absensi_guru', function (Blueprint $table) {
            $table->enum('status', [
                'mengajar',
                'izin',
                'terlambat',
                'tidak_hadir'
            ])->default('mengajar')->change();
        });
    }

    public function down(): void
    {
        Schema::table('absensi_guru', function (Blueprint $table) {
            $table->string('status')->change();
        });
    }
};
