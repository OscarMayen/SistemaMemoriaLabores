<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TipoActividad extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nomTipoAct',
    ];

    public function actividades(){
        return $this->hasMany('App\Model\Actividad');
    }
}
