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
        Schema::create('ambientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->integer('capacidad');
            $table->string('estado')->default('disponible');
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('sucursal_id');                            //foranea
            $table->foreign('sucursal_id')->on('sucursales')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambientes');
    }
};
