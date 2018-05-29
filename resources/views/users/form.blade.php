{{ csrf_field() }}		
<label for="name">
	Nombre
	<input class="form-control" type="text" name="name" value="{{ $user->name or old('name') }}">
{!! $errors->first('name', '<span class=alert alert-danger>:message</span>') !!}
</label><br><br>

<label for="email">
	Email
	<input class="form-control" type="email" name="email" value="{{ $user->email or old('email') }}">
	{!! $errors->first('email', '<span class=alert alert-danger>:message</span>') !!}
</label>
<br><br>	

@unless($user->id)
	<label for="password">
		Password
		<input class="form-control" type="password" name="password">
		{!! $errors->first('password', '<span class=alert alert-danger>:message</span>') !!}
	</label>
	<br><br>

	<label for="password_confirmation">
		Password confirm
		<input class="form-control" type="password" name="password_confirmation">
		{!! $errors->first('password_confirmation', '<span class=alert alert-danger>:message</span>') !!}
	</label>
	<br><br>
@endunless


<div class="checkbox">
	@foreach($roles as $id => $name)
		<label>
			<input 
			type="checkbox" 
			name="roles[]" 
			{{ $user->roles->pluck('id')->contains($id) ? 'checked' : '' }}
			value="{{ $id }}">
			{{ $name }}			
		</label>
	@endforeach <br>
	{!! $errors->first('roles', '<span class=alert alert-danger>:message</span>') !!}
</div>