@extends('layout')

@section('contenido')
	<h1>Contactos</h1><hr>
	<h2>Escríbeme</h2>
	

	@if( session()->has('info'))
		{{ session('info') }}
	@else


	<form method="POST" action="{{ route('mensajes.store') }}">		
		<input type="hidden" name="_token" value="{{ csrf_token() }}">		
		<label for="nombre">
			Nombre
			<input class="form-control" type="text" name="nombre" value="{{ old('nombre') }}">
		{!! $errors->first('nombre', '<span class=error>:message</span>') !!}
		</label><br><br>

		<label for="email">
			Email
			<input class="form-control" type="email" name="email" value="{{ old('email') }}">
		</label>
		{!! $errors->first('email', '<span class=error>:message</span>') !!}
		<br><br>

		<label for="mensaje">
			Mensaje
			<textarea class="form-control" name="mensaje">{{ old('mensaje') }}</textarea>
		</label>
		{!! $errors->first('mensaje', '<span class=error>:message</span>') !!}
		<br>

		<input class="btn btn-primary" type="submit" value="Enviar">
	</form>
	@endif
	<hr>
@stop