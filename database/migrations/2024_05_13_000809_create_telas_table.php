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
        Schema::create('telas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('precioCompra', 8, 2);
            $table->decimal('precioMayor', 8, 2);
            $table->decimal('precioMenor', 8, 2);
            $table->decimal('precioRollo', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telas');
    }
};
