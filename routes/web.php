<?php


// Route::get('test', function(){
// 	$user = new App\User;
// 	$user->name = 'Francisco';
// 	$user->email = 'fmiranda@deuce.com';
// 	$user->password = bcrypt('123123');
// 	$user->save();

// 	return $user;
// });


Route::get('/', ['as' => 'home' , 'uses' => 'PagesController@home'])->middleware('example');


Route::get('saludos/{nombre?}', ['as' => 'saludos', 'uses' => 'PagesController@saludo'])->where('nombre', "[A-Za-z]+");

Route::resource('mensajes', 'MessagesController');

Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');



