<?php

namespace App\RolesPermission\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //es: desde aqui
    //en: from here
    protected $fillable = [
        'name', 'slug', 'description',
    ];

    public function roles(){
        return $this->belongsToMany('App\RolesPermission\Model\Role')->withTimesTamps();
    }
}
