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
        Schema::create('evaluacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consulta_id')->unique();
            $table->string('localidad')->nullable();
            $table->string('aparicion')->nullable();
            $table->string('duracion')->nullable();
            $table->string('intensidad')->nullable();
            $table->string('caracter')->nullable();
            $table->string('irradiacion')->nullable();
            $table->string('atenuantes')->nullable();
            $table->foreign('consulta_id')->references('id')->on('consultas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluacions');
    }
};
