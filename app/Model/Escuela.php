<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nomEscuela',
        'codEscuela',
        'facultad_id',
    ];

    public function facultades(){
        return $this->belongsTo('App\Model\Facultad');
    }

    public function memorias(){
        return $this->hasMany('App\Model\Memoria');
    }
}
