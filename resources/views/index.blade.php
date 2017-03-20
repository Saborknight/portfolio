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
			<h1>About</h1>
			<h5>A little bit about me...</h5>
		</div>
	</div>
</div>

<div class="about-links-wrapper">
	<a href="{{ \URL::route('projects') }}">
		<span class="about-links">Projects</span>
	</a>
</div>
@endsection
