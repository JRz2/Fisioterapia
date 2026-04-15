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
        Schema::create('ejercicio_patologias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ejercicio_id')->constrained()->onDelete('cascade');
            $table->foreignId('patologia_id')->constrained()->onDelete('cascade');
            $table->float('nivel_evidencia')->default(1.0);  
            $table->integer('orden_recomendacion')->default(0);  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ejercicio_patologias');
    }
};
