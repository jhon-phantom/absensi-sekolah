<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->boolean('is_ketua')->default(false);
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn('is_ketua');
            $table->dropConstrainedForeignId('user_id');
        });
    }
};
