@extends('layout')


@section('contenido')
	
	<h1>Todos los mensajes</h1>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Email</th>
				<th>Mensaje</th>
				<th>Notas</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($messages as $message)
			<tr>
				<td>{{ $message->id }}</td>
				@if($message->user_id)
					<td>
						<a href="{{ route('usuarios.show', $message->user_id) }}">
							{{ $message->user->name }}
						</a>
					</td>
					<td>{{ $message->user->email }}</td>
				@else
					<td>											
						{{ $message->nombre }}				
					</td>
					<td>{{ $message->email }}</td>
				@endif
				<td>
					<a href="{{ route('mensajes.show', $message->id) }}">
						{{ $message->mensaje }}
					</a>
				</td>
				<td>
					@if($message->note)
						{{ $message->note->body }}
					@endif
				</td>
				<td>
					<a class="btn btn-info btn-xs" href="{{ route('mensajes.edit', $message->id) }}">
						Editar
					</a>	
					<form style="display: inline;" method="POST" action="{{ route('mensajes.destroy', $message->id) }}">
						{{ method_field('DELETE') }} {{ csrf_field() }}
						<button class="btn btn-danger btn-xs" type="submit">
							Eliminar
						</button>
					</form>
				</td>
			</tr>				
			@endforeach
		</tbody>
	</table>

@stop