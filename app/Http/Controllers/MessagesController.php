<?php

namespace App\Http\Controllers;

use App\Events\MessageWasReceived;
use App\Message;
use App\Repositories\CacheMessages;
use App\Repositories\Messages;
use App\Repositories\MessagesInterface;
use App\note;
use App\tags;
use App\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MessagesController extends Controller
{
    protected $messages;
    public function __construct(MessagesInterface $messages)
    {
        $this->messages = $messages;
        $this->middleware('auth', ['except' => ['create', 'store'] ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $messages = $this->messages->getPaginated();

        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = $this->messages->store($request);

        event(new MessageWasReceived($message));
        //redireccionar
        return redirect()->route('mensajes.create')->with('info', 'Hemos recibido su mensaje');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $message = $this->messages->findById($id);

        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = $this->messages->findById($id);

        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Actualizamos
        // DB::table('messages')->where('id', $id)->update([
        //     "nombre" => $request->input('nombre'),
        //     "email" => $request->input('email'),
        //     "mensaje" => $request->input('mensaje'),
        //     "updated_at" => Carbon::now()
        // ]);

        $message = $this->messages->update($request, $id);        

        //redireccionamos
        return redirect()->route('mensajes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // DB::table('messages')->where('id', $id)->delete();
        $message = $this->messages->destroy($id);

        return redirect()->route('mensajes.index');
    }
}
