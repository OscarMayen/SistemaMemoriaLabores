<?php

namespace App\RolesPermission\Traits;

trait UserTrait {

    //es: desde aqui
    //en: from here

    public function roles(){
        return $this->belongsToMany('App\RolesPermission\Model\Role')->withTimesTamps();
    }

    public function havePermission($permission){

        foreach($this->roles as $role){
            if ($role['full-access'] == 'si'){
                return true;
            }

            foreach($role->permissions as $perm){

                if ($perm->slug == $permission){
                    return true;
                }
            }
        }
        return false;
    }
}
