<?php


Route::get('/', ['as' => 'home' , 'uses' => 'PagesController@home'])->middleware('example');

Route::get('contactame', ['as' => 'contactos', 'uses' => 'PagesController@contact']);

Route::get('saludos/{nombre?}', ['as' => 'saludos', 'uses' => 'PagesController@saludo'])->where('nombre', "[A-Za-z]+");

Route::post('contacto', 'PagesController@mensajes');


Route::resource('mensajes', 'MessagesController');



