<?php

namespace App;

trait HasRoles {


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function assignRole($role)
    {
       return $this->roles()->save(
            Role::whereId($role)->firstOrFail()
        );
    }

    public function hasRole($roles)
    {
        // $valRole = false;
        
        // if (is_array($role)) {

        //     foreach ($role as $r) {

        //         if ($this->roles->contains('name', $r) == true) {

        //             $valRole = true;

        //         }
        //     }

        //     if ($valRole == true) {
        //         return true;
            
        //     } else {
            
        //         return false;
            
        //     }


        // } else {
        //     if (is_string($role)) {
        //         return $this->roles->contains('name', $role);
        //     }

        //     return !! $role->intersect($this->roles)->count();
        // }
        if (is_string($roles)) {
            return $this->roles->contains('name', $roles);
        }
        if ($roles instanceof Role) {
            return $this->roles->contains('id', $roles->id);
        }
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
            return false;
        }
        return (bool) $roles->intersect($this->roles)->count();
        
    }
}