<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<!-- Scripts -->
	<script>
		window.Laravel = {!! json_encode([
			'csrfToken' => csrf_token(),
		]) !!};
	</script>
	@yield('header')
</head>
<body>
	<div id="app">
		{{-- Menu Sidebar --}}
		<div id="menu-wrapper">
			<ul class="menu-nav">
				<li class="menu-brand">
					<a href="{{ route('index') }}">
						<img class="logo" src="{{ URL::asset('/img/logo.svg') }}" alt="Brink Creative: logo" height="200" width="200">
					</a>
				</li>
				<?php $controller = new App\Http\Controllers\Controller; ?>
				@foreach ($controller->getMenuItems() as $name => $url)
					<li>
						<a href="{{ $url }}">{{ ucwords($name) }}</a>
					</li>
				@endforeach
				@if (Auth::check())
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="{{ route('logout') }}"
									onclick="event.preventDefault();
											 document.getElementById('logout-form').submit();">
									Logout
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
						</ul>
					</li>
				@endif
			</ul>
		</div>
		<button id="menu-toggle" type="button" class="drop-bars">
			<span class="sr-only">Toggle Menu</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>

		<main class="content">
			@yield('content')
		</main>

		<footer class="container">
			<div class="row">
				<div class="col-sm-12">
					@if (Auth::guest())
						<a class="link-login" href="{{ route('login') }}">Login</a>
					@else
					@endif
				</div>
			</div>
		</footer>
	</div>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
