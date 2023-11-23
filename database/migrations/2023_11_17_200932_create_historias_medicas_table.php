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
        Schema::create('historias_medicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profesional_id')->constrained('usuarios');
            $table->foreignId('paciente_id')->constrained('usuarios');
            $table->dateTime('hora_fecha');
            $table->string('consecutivo');
            $table->text('estado_paciente');
            $table->text('antecedentes');
            $table->text('evolucion_final');
            $table->text('concepto_profesional');
            $table->text('recomendaciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historias_medicas');
    }
};
