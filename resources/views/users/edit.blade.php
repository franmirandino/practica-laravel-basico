@extends('layout')

@section('contenido')

	<h1>Editar Usuario</h1>

	@if(session()->has('info'))
		<div class="alert alert-success">
			{{ session('info') }}
		</div>
	@endif

	<form method="POST" action="{{ route('usuarios.update', $user->id) }}">		
		{{ method_field('PUT') }} {{ csrf_field() }}		
		<label for="name">
			Nombre
			<input class="form-control" type="text" name="name" value="{{ old('name', $user->name) }}">
		{!! $errors->first('name', '<span class=alert alert-danger>:message</span>') !!}
		</label><br><br>

		<label for="email">
			Email
			<input class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}">
		</label>
		{!! $errors->first('email', '<span class=alert alert-danger>:message</span>') !!}
		<br><br>		

		<input class="btn btn-primary" type="submit" value="Enviar">
	</form>

@stop