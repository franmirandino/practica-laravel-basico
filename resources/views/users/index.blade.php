@extends('layout')

@section('contenido')
	<h1>Usuarios</h1>

	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Email</th>
				<th>Role</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
			<tr>
				<td>{{ $user->id }}</td>				
				<td>{{ $user->name }}</td>				
				<td>{{ $user->email }}</td>				
				<td>
					@foreach($user->roles as $role)
						{{ $role->display_name }}
					@endforeach
				</td>				
				<td>Editar</td>				
			</tr>				
			@endforeach
		</tbody>
	</table>
@stop