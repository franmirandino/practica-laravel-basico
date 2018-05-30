<?php

namespace App\Http\Controllers;

use App\Events\MessageWasReceived;
use App\Message;
use App\note;
use App\tags;
use App\user;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['create', 'store'] ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $key = "messages.page." . request('page', 1);

        $messages = Cache::rememberForever($key, function(){
            return  Message::with(['user', 'note', 'tags'])
                         ->orderBy('created_at', request('sorted', 'DESC'))
                         ->paginate(10);
        });

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
        $message = Message::create($request->all());
        $message->user_id = auth()->id();
        $message->save();

        event(new MessageWasReceived($message));

        Cache::flush();
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

        $message = Cache::rememberForever("messages.{$id}", function() use ($id){
            return Message::findOrFail($id);
        });

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
        $message = Cache::rememberForever("messages.{$id}", function() use ($id){
            return Message::findOrFail($id);
        });

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

        $message = Message::findOrFail($id);
        $message->update($request->all());

        Cache::flush();

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
        $message = Message::findOrFail($id)->delete();

        Cache::flush();

        return redirect()->route('mensajes.index');
    }
}
