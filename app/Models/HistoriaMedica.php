<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriaMedica extends Model
{
    use HasFactory;

    protected $table = 'historias_medicas';

    protected $fillable = [
        'profesional_id',
        'paciente_id',
        'hora_fecha',
        'consecutivo',
        'estado_paciente',
        'antecedentes',
        'evolucion_final',
        'concepto_profesional',
        'recomendaciones',
        'asistida',
    ];

    protected $casts = [
        'hora_fecha' => 'datetime',
        'asistida' => 'boolean',
    ];

    public function profesional()
    {
        return $this->belongsTo(Profesional::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
