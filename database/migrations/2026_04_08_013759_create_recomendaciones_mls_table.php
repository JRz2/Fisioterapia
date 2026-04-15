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
        Schema::create('recomendaciones_mls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained();
            $table->foreignId('ejercicio_id')->constrained();
            $table->string('contexto');
            $table->float('peso_recomendacion')->default(1.0);  
            $table->integer('veces_recomendado')->default(0);
            $table->integer('veces_completado_exitoso')->default(0);
            $table->float('tasa_exito')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recomendaciones_mls');
    }
};
