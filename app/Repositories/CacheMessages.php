<?php 


namespace App\Repositories;

use Illuminate\Support\Facades\Cache;


class CacheMessages implements MessagesInterface
{
	protected $messages;
	public function __construct(Messages $messages)
	{
		$this->messages = $messages;
	}

	public function getPaginated()
	{
		$key = "messages.page." . request('page', 1);

        return Cache::tags('messages')->rememberForever($key, function(){
            return  $this->messages->getPaginated();
        });

	}

	public function store($request)
	{
		$message = $this->messages->store($request);
		Cache::tags('messages')->flush();
		return $message;
	}

	public function findById($id)
	{
		return Cache::tags('messages')->rememberForever("messages.{$id}", function() use ($id){
            return $this->messages->findById($id);
        });
	}

	public function update($request, $id)
	{
		$message = $this->messages->update($request, $id);
		Cache::tags('messages')->flush();

		return $message;

	}

	public function destroy($id)
	{
		$message = $this->messages->destroy($id);
		Cache::tags('messages')->flush();

		return $message;

	}
}