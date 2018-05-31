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
				<th>Etiquetas</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($messages as $message)
			<tr>
				<td>{{ $message->id }}</td>

				<td>{!! $message->present()->userName() !!}</td>
				<td>{{ $message->present()->userEmail() }}</td>
				<td>{!! $message->present()->link() !!}	</td>
				<td>{{ $message->present()->notes() }}</td>
				<td>{{ $message->present()->tags() }}</td>
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
			{!! $messages->appends(request()->query())->links('pagination::bootstrap-4') !!}

@stop