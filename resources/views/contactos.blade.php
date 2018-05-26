@extends('layout')

@section('contenido')
	<h1>Contactos</h1>
	<h2>Escríbeme</h2>
	

	@if( session()->has('info'))
		{{ session('info') }}
	@else


	<form method="POST" action="contacto">
		{{ csrf_token() }}
		<label for="nombre">
			Nombre
			<input type="text" name="nombre" value="{{ old('nombre') }}">
		{!! $errors->first('nombre', '<span class=error>:message</span>') !!}
		</label><br><br>

		<label for="email">
			Email
			<input type="email" name="email" value="{{ old('email') }}">
		</label>
		{!! $errors->first('email', '<span class=error>:message</span>') !!}
		<br><br>

		<label for="mensaje">
			Mensaje
			<textarea name="mensaje">{{ old('mensaje') }}</textarea>
		</label>
		{!! $errors->first('mensaje', '<span class=error>:message</span>') !!}
		<br>

		<input type="submit" value="Enviar">
	</form>
	@endif
	<hr>
@stop