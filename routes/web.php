<?php


//revisamos la cantidad de consultas a la base de datos
// DB::listen(function($query){
// 	echo "<pre>{ $query->sql }</pre>";
// });


// App\User::create([
// 	'name' => 'Moderador',
// 	'email'=> 'moderador@fake.com',
// 	'password' => bcrypt('123123'),
// ]);

Route::get('roles', function(){
	return App\Role::with('user')->get();
});


Route::get('/', ['as' => 'home' , 'uses' => 'PagesController@home'])->middleware('example');


Route::get('saludos/{nombre?}', ['as' => 'saludos', 'uses' => 'PagesController@saludo'])->where('nombre', "[A-Za-z]+");

Route::resource('mensajes', 'MessagesController');
Route::resource('usuarios', 'UsersController');

Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');



