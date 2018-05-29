<?php

namespace App;

use App\Message;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function messages()
    {
    	return $this->morphedByMany(Message::class, 'taggable');
    }

        public function users()
    {
    	return $this->morphedByMany(User::class, 'taggable');
    }

}
