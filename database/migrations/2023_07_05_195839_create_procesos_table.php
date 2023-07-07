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
        Schema::create('procesos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('descripcion')->nullable();
            $table->decimal('ph_inicial',8,2)->nullable();
            $table->decimal('ph_esperado',8,2)->nullable();
            $table->decimal('cloro_inicial',8,2)->nullable();
            $table->decimal('cloro_esperado',8,2)->nullable();
            $table->decimal('ph_final',8,2)->nullable();
            $table->decimal('cloro_final',8,2)->nullable();
            $table->decimal('volumen_pro',8,2)->nullable();
            $table->string('urlPH')->nullable();
            $table->string('urlCL')->nullable();
            /* $table->unsignedBigInteger('piscina_id');                            //foranea
            $table->foreign('piscina_id')->on('piscinas')->references('id')->onDelete('cascade'); */
            //$table->string('imagen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
    */
    
    public function down(): void
    {
        Schema::dropIfExists('procesos');
    }
};
