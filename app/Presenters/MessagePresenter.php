<?php 

namespace App\Presenters;

use App\Message;
use Illuminate\Support\HtmlString;


class MessagePresenter extends Presenter
{

    public function userName()
    {
        if ($this->model->user_id) {
            return $this->userLink();
        }
        return $this->model->nombre;
    }

    public function userEmail()
    {
        if ($this->model->user_id) {
            return $this->model->user->email;
        }
        return $this->model->email;
    }

    public function link()
    {
    	return new HtmlString("<a href='" . route('mensajes.show', $this->model->id) . "'>{$this->model->mensaje}</a>");
    }

    public function userLink()
    {
    	return $this->model->user->present()->link();

    }

    public function notes()
    {
    	return $this->model->note ? $this->model->note->body : '';
    }

    public function tags()
    {
    	return $this->model->tags->pluck('name')->implode(', ');
    }

}