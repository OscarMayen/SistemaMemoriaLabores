<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Memoria extends Model
{
    protected $fillable = [
        'titulo',
        'escuela_id',
    ];

    public function escuelas(){
        return $this->belongsTo('App\Model\Escuela');
    }
}
