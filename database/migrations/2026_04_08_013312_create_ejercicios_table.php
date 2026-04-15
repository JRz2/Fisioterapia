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
        Schema::create('ejercicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); 
            $table->text('descripcion');  
            $table->string('video_url')->nullable();  
            $table->string('imagen_url')->nullable();  
            $table->enum('dificultad', ['baja', 'media', 'alta'])->default('baja');
            $table->string('zona_corporal');  
            $table->integer('series_recomendadas')->default(3);
            $table->integer('repeticiones_recomendadas')->default(12);
            $table->text('indicaciones_seguridad')->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ejercicios');
    }
};
