<?php

namespace App;

use App\Note;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['nombre', 'email', 'mensaje'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function note()
    {
    	return $this->morphOne(Note::class, 'notable');
    }


}
