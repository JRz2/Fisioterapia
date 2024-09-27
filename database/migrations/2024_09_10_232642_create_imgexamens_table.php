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
        Schema::create('imgexamens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('examen_id');
            $table->string('ruta')->nullable();
            $table->foreign('examen_id')->references('id')->on('examens');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imgexamens');
    }
};
