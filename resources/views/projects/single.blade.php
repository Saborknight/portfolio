@extends('layouts.app')

@section('header')
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>My Projects</h1>
		</div>
	</div>

	@if ($projects)
		@foreach ($projects as $project)
			<div class="row">
				<div class="col-xs-12">
					<div class="tag-wrapper-project">
						@if (count($project->categories))
							@foreach ($project->categories as $category)
								<span class="tag-project" data-category-color="{{ $category->color }}">{{ $category->name }}</span>
							@endforeach
						@endif
					</div>

					<h2>{{ $project->name }}</h2>
					<h5>Author</h5>
					<p>{{ $project->body }}</p>
				</div>
			</div>
		@endforeach

	@else

		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-warning" role="alert">
				    <strong>Oh dear!</strong> These are not the projects you are looking for.
				</div>
			</div>
		</div>
	@endif

</div>
@endsection
