<h1>Hello there!</h1>
<p>Check out my <strong>Projects!</strong></p>
@if ($projects)
	@foreach ($projects as $project)
		<p>{{ $project }}</p>
	@endforeach
@else
	<p>Sorry, no Projects found :(</p>
@endif