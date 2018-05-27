@extends('layout')

@section('contenido')

	<h1>Editar mensaje</h1>

	<form method="POST" action="{{ route('mensajes.update', $message->id) }}">		
		{{ method_field('PUT') }} {{ csrf_field() }}		
		<label for="nombre">
			Nombre
			<input class="form-control" type="text" name="nombre" value="{{ old('nombre', $message->nombre) }}">
		{!! $errors->first('nombre', '<span class=error>:message</span>') !!}
		</label><br><br>

		<label for="email">
			Email
			<input class="form-control" type="email" name="email" value="{{ old('email', $message->email) }}">
		</label>
		{!! $errors->first('email', '<span class=error>:message</span>') !!}
		<br><br>

		<label for="mensaje">
			Mensaje
			<textarea class="form-control" name="mensaje">{{ old('mensaje', $message->mensaje) }}</textarea>
		</label>
		{!! $errors->first('mensaje', '<span class=error>:message</span>') !!}
		<br>

		<input class="btn btn-primary" type="submit" value="Enviar">
	</form>

@endsection