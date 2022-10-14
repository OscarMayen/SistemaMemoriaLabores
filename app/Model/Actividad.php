<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $fillable = [
        'nomActividad',
        'contenido',
        'fechaActividad',
    ];

    public function tipoActividades(){
        return $this->belongsTo('App\Model\TipoActividad');
    }
}
