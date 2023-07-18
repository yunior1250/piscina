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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); 
            $table->string('descripcion');
            $table->integer('precio');   
            $table->date('fecha_ini');
            $table->date('fecha_fin');
             $table->integer('estado')->nullable();

            $table->unsignedBigInteger('ambiente_id');                            //foranea
            $table->foreign('ambiente_id')->on('ambientes')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
