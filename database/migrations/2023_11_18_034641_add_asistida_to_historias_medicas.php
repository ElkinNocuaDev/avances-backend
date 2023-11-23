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
        Schema::table('historias_medicas', function (Blueprint $table) {
            // Se puede cambiar el valor predeterminado según los requerimientos
            $table->boolean('asistida')->default(false); 
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historias_medicas', function (Blueprint $table) {
            //
        });
    }
};
