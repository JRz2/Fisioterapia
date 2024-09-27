<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movilizacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consulta_id')->unique();
            $table->text('contractura')->nullable();
            $table->text('retraccion')->nullable();
            $table->text('gatillo')->nullable();
            $table->text('goniometria')->nullable();
            $table->text('balance_muscular')->nullable();
            $table->text('mensuras')->nullable();
            $table->text('perimetros')->nullable();
            $table->foreign('consulta_id')->references('id')->on('consultas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movilizacions');
    }
};
