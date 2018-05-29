<?php

namespace App;

use App\Message;
use App\Role;
use App\Tag;
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

    //creamos un mutador para que cuando se guarde una contraseña se encrypte automaticamente
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'assigned_roles');
    }

    public function hasRole(array $roles){

    
        return $this->roles->pluck('name')->intersect($roles)->count();
                
        

        return false;            

    }

    public function isAdmin(){
        return $this->hasRole(['admin']);
    }

    public function messages()
    {
       return $this->hasMany(Message::class);
    }

    public function note()
    {
        return $this->morphOne(Note::class, 'notable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimesTamps();
    }

}
