<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<style>
		.active{
			text-decoration: none;
			color: green;
		}
		.error{
			color: red;
			font-size: 12px;
		}
	</style>
	<title>Mi Sitio</title>
</head>
<body>
	<header>
		<?php 
			function activeMenu($url)
			{
				return request()->is($url) ? 'active' : '';
			}
		?>
		<nav>
			<a class="{{ activeMenu('/') }}" href="{{ route('home') }}">Inicio</a>
			<a class="{{ activeMenu('saludos*') }}" href="{{ route('saludos') }}">Saludo</a>
			<a class="{{ activeMenu('mensajes/create') }}" href="{{ route('mensajes.create') }}">Contactos</a>
			<a class="{{ activeMenu('mensajes') }}" href="{{ route('mensajes.index') }}">Mensajes</a>
		</nav>
	</header>
	
	@yield('contenido')

	<footer>Copyrigth {{ date('Y') }}</footer>
</body>
</html>