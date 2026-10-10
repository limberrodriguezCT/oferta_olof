<?php

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
        Schema::create('interesados', function (Blueprint $table) {
         $table->id();
        $table->foreignId('carrera_id')->constrained('carreras')->onDelete('cascade');
        $table->string('nombre_completo');
        $table->string('telefono');
        $table->string('correo')->nullable();
        $table->timestamps(); // El created_at nos servirá para las fechas en los gráficos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interesados');
    }
};
