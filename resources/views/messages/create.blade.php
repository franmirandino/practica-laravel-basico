@extends('layout')

@section('contenido')
	<h1>Contactos</h1><hr>
	<h2>Escríbeme</h2>
	

	@if( session()->has('info'))
		{{ session('info') }}
	@else

	<form method="POST" action="{{ route('mensajes.store') }}">		
		@include('messages.form')
	</form>
	@endif
	<hr>
@stop