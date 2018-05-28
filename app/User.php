<?php

namespace App;

use App\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class, 'assigned_roles');
    }

    public function hasRole(array $roles){

        foreach ($roles as $role) {

            foreach ($this->roles as $userRole) {
                
                if($userRole->name === $role){
                    return true;
                }

            }
            
        }

        return false;            

    }

    public function isAdmin(){
        return $this->hasRole(['admin']);
    }
}
