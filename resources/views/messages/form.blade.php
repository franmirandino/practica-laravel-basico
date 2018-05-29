<input type="hidden" name="_token" value="{{ csrf_token() }}">
@unless( isset($message) and $message->user_id )
	<label for="nombre">
		Nombre
		<input class="form-control" type="text" name="nombre" value="{{ $message->nombre or old('nombre') }}">
	{!! $errors->first('nombre', '<span class=error>:message</span>') !!}
	</label><br><br>

	<label for="email">
		Email
		<input class="form-control" type="email" name="email" value="{{ $message->email or old('email') }}">
	</label>
	{!! $errors->first('email', '<span class=error>:message</span>') !!}
	<br><br>
@endunless	

<label for="mensaje">
	Mensaje
	<textarea class="form-control" name="mensaje">{{ $message->mensaje or old('mensaje') }}</textarea>
</label>
{!! $errors->first('mensaje', '<span class=error>:message</span>') !!}
<br>

<input class="btn btn-primary" type="submit" value="{{ $btnText or 'Guardar'}}">