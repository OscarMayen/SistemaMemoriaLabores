<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nomFacultad',
    ];

    public function escuelas(){
        return $this->hasMany('App\Model\Escuela');
    }
}
