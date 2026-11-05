<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('matriculas', function (Blueprint $table) {
            $table->string('turno')->nullable()->change();
        });
    }

    public function down(): void
    {
        if (DB::table('matriculas')->whereNull('turno')->exists()) {
            throw new RuntimeException('Cannot require turno while enrollments without turno exist.');
        }

        Schema::table('matriculas', function (Blueprint $table) {
            $table->string('turno')->nullable(false)->change();
        });
    }
};
