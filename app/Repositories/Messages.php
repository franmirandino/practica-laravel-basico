<?php

namespace App\Repositories;

use App\Message;
use Illuminate\Support\Facades\Cache;

class Messages
{
	public function getPaginated()
	{
        $key = "messages.page." . request('page', 1);

        return Cache::tags('messages')->rememberForever($key, function(){
            return  Message::with(['user', 'note', 'tags'])
                         ->orderBy('created_at', request('sorted', 'DESC'))
                         ->paginate(10);
        });
	}

	public function store($request)
	{
		$message = Message::create($request->all());
        $message->user_id = auth()->id();
        $message->save();

        Cache::tags('messages')->flush();

        return $message;
	}

	public function findById($id)
	{
		return Cache::tags('messages')->rememberForever("messages.{$id}", function() use ($id){
            return Message::findOrFail($id);
        });
	}

	public function update($request, $id)
	{
		Cache::tags('messages')->flush();

		return Message::findOrFail($id)->update($request->all());      
	}

	public function destroy($id)
	{
        Cache::tags('messages')->flush();

		return Message::findOrFail($id)->delete();

	}

}