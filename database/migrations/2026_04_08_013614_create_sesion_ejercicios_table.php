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
        Schema::create('sesion_ejercicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sesion_id')->constrained()->onDelete('cascade');
            $table->foreignId('ejercicio_id')->constrained();
            $table->integer('series_realizadas')->nullable();
            $table->integer('repeticiones_realizadas')->nullable();
            $table->enum('calidad_ejecucion', ['excelente', 'buena', 'regular', 'mala'])->nullable();
            $table->boolean('completado')->default(false);
            $table->text('observacion_paciente')->nullable(); 
            $table->integer('puntos_ganados')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesion_ejercicios');
    }
};
