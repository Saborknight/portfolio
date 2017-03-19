@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="tag-wrapper-project">
				@if (count($project->categories))
					@foreach ($project->categories as $category)
						<span class="tag-project" data-category-color="{{ $category->color }}">{{ $category->name }}</span>
					@endforeach
				@endif
			</div>

			<h1>{{ $project->name }}</h1>
			<h5>Author</h5>
			<p>{{ $project->body }}</p>
		</div>
	</div>
</div>

@endsection
