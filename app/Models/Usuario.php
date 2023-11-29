<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $fillable = [
        'numero_identificacion',
        'nombre',
        'apellidos',
        'correo',
        'celular',
        'ubicacion',
        'password',
        'tipo',
    ];

    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // En el modelo Usuario.php
    public function historiasMedicasComoPaciente()
    {
        return $this->hasMany(HistoriaMedica::class, 'paciente_id');
    }

    public function historiasMedicasComoProfesional()
    {
        return $this->hasMany(HistoriaMedica::class, 'profesional_id');
    }

}
