<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Vacante extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['titulo', 'imagen', 'descripcion', 'skills', 'categoria_id', 'experiencia_id', 'ubicacion_id', 'salario_id'];

    // obtiene la categoria de la receta via FK (1:1)
    public function categoria()
    {
        /* 
        1:1 -> belongsTo
        1:n -> belongsTo
        n:n -> belongsToMany
        */
        return $this->belongsTo(Categoria::class);
    }

    // obtener la experiencia de la vacante, relacion 1:1 fk
    public function experiencia()
    {
        return $this->belongsTo(Experiencia::class);
    }

    // obtener la ubicacion de la vacante, relacion 1:1 fk
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    // 1:1
    public function salario()
    {
        return $this->belongsTo(Salario::class);
    }

    public function reclutador()
    {
        // se debe pasar el fk
        return $this->belongsTo(User::class, 'user_id');
    }

    // obtener todos los cantidatos de una vacante 1:n
    public function candidatos()
    {
        return $this->hasMany(Candidato::class);
    }
}
