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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consulta_id');
            $table->integer('sesiones');
            $table->string('dia'); 
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->foreign('consulta_id')->references('id')->on('consultas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
