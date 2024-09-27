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
        Schema::create('imgsesions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sesion_id');
            $table->string('ruta')->nullable();
            $table->foreign('sesion_id')->references('id')->on('sesions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imgsesions');
    }
};
