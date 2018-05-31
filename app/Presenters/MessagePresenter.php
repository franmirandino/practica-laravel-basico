<?php 

namespace App\Presenters;

use App\Message;

class MessagePresenter
{
	protected $message;

	public function __construct(Message $message)
	{
		$this->message = $message;
	}

    public function userName()
    {
        if ($this->message->user_id) {
            return $this->userLink();
        }
        return $this->message->nombre;
    }

    public function userEmail()
    {
        if ($this->message->user_id) {
            return $this->message->user->email;
        }
        return $this->message->email;
    }

    public function link()
    {
    	return "<a href='" . route('mensajes.show', $this->message->id) . "'>{$this->message->mensaje}</a>";
    }

    public function userLink()
    {
    	return "<a href='" . route('usuarios.show', $this->message->user->id) . "'>{$this->message->user->name}</a>";

    }

    public function notes()
    {
    	return $this->message->note ? $this->message->note->body : '';
    }

    public function tags()
    {
    	return $this->message->tags->pluck('name')->implode(', ');
    }

}