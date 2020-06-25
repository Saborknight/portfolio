@extends('layouts.app')

@section('content')
<div class="hero-logo">
	<div class="row">
		<div class="wrapper-logo">
			<img src="{{ \URL::asset('images/logo.svg') }}" alt="Brink." height="500" width="500">
		</div>
	</div>
</div>

<div class="go-downward-wrapper">
	<a href="#about">
		<i class="go-downward"></i>
	</a>
</div>

<div class="container">
	<div class="row">
		<div id="about" class="col-sm-12 parse-area">
			@php
				$parse = new Parsedown();
				$url = 'about.md';

				try {
					$about = File::get($url);
				} catch (Illuminate\Filesystem\FileNotFoundException $exception) {
					die ('Bad File');
				}

				echo $parse->text($about);
			@endphp
		</div>
	</div>
</div>

<h1 class="button-wrapper">
	<a href="{{ \URL::route('projects') }}">
		<span class="button">My Projects</span>
	</a>
</h1>
@endsection
