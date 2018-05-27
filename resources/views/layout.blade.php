<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/css/app.css">
	<title>Mi Sitio</title>
</head>
<body>
	<header>

		<nav class="navbar navbar-default" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Title</a>
				</div>
		
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						<li class="{{ activeMenu('/') }}">
							<a href="{{ route('home') }}">Inicio</a>
						</li>
						<li class="{{ activeMenu('saludos*') }}">
							<a href="{{ route('saludos') }}">Saludo</a>
						</li>
						<li class="{{ activeMenu('mensajes/create') }}">
							<a href="{{ route('mensajes.create') }}">Contactos</a>						
						</li>							

						@if(auth()->check())
							<li class="{{ activeMenu('mensajes') }}">
								<a href="{{ route('mensajes.index') }}">Mensajes</a>
							</li>													
						@endif									
					</ul>
					<ul class="nav navbar-nav navbar-right">
						@if(auth()->guest())
							<li class="{{ activeMenu('/login') }}">
								<a href="/login">Login</a>
							</li>
						@else
							<li>
								<a href="/logout">Cerrar sesión de {{ auth()->user()->name }}</a>	
							</li>
						@endif	
						{{-- <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</li> --}}
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>


		<?php 
			function activeMenu($url)
			{
				return request()->is($url) ? 'active' : '';
			}
		?>
	</header>
	<div class="container">
		
		@yield('contenido')

		<footer>Copyrigth {{ date('Y') }}</footer>
		
	</div>
	
</body>
</html>