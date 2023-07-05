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
        Schema::create('piscinas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('tipo');
            $table->decimal('ancho', 8, 2);
            $table->decimal('largo', 8, 2);

         
         
            $table->decimal('profundidad', 8, 2);
            $table->decimal('radio', 8, 2);
            $table->decimal('volumen', 8, 2);
            $table->string('imagen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piscinas');
    }
};
