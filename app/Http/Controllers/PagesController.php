<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageRequest;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    
    public function home()
    {
    	return view('home');
    }

    public function contact()
    {
    	return view('contactos');
    }

    public function saludo($nombre = 'invitado')
    {
    	
    	$html = "<h2>Contenido html</h2>";

    	return view('saludo', compact('html', 'nombre'));
    }

    public function mensajes(CreateMessageRequest $request)
    {
    	$data = $request->all();

    	return back()->with('info', 'Tu mensaje ha sido enviado correctamente');
    }
}
