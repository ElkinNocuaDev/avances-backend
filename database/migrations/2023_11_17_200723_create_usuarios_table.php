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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('numero_identificacion')->unique();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('correo')->unique();
            $table->string('celular');
            $table->string('ubicacion');
            $table->string('password');
            $table->enum('tipo', ['profesional', 'paciente']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
