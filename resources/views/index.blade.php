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
	<a href="#">
		<i class="go-downward"></i>
	</a>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
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

<div class="about-links-wrapper">
	<a href="{{ \URL::route('projects') }}">
		<span class="about-links">Projects</span>
	</a>
</div>
@endsection
