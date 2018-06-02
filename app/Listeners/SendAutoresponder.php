<?php

namespace App\Listeners;

use App\Events\MessageWasReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendAutoresponder implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  MessageWasReceived  $event
     * @return void
     */
    public function handle(MessageWasReceived $event)
    {
        $message = $event->message;

        if(auth()->check())
        {
            $message->email = auth()->user()->email;
        }

        Mail::send('emails.contact',['msg' => $message], function($m) use ($message){
            $m->to($message->email, $message->name)->subject('tu mensaje fue recibido');
        });
    }
}
