@extends('layouts.app')

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
					<h2>
						<a href="{{ \URL::route('projects.single', ['project' => $project->permalink]) }}">{{ $project->name }}</a>

						{{-- Show Categories --}}
						@if (count($project->categories))
							@foreach ($project->categories as $category)
								<span class="tag-project" data-category-color="{{ $category->color }}">
									<a href="{{ \URL::route('projects', ['category' => $category->name]) }}">
										{{ $category->name }}
									</a>
								</span>
							@endforeach
						@endif

						{{-- Show Status if not Published --}}
						@if ($project->state === 'drafted')
							<span class="state-drafted"><a href="{{ \URL::route('projects.store', ['project' => $project->id]) }}">Draft</a></span>
						@elseif ($project->state === 'archived')
							<span class="state-archived"><a href="{{ \URL::route('projects.store', ['project' => $project->id]) }}">Archived</a></span>
						@endif

					</h2>

						{{-- Show relevant Authors --}}
						@if (count($project->authors))
							@foreach ($project->authors as $author)
								<h5><a href="{{ url('/about') }}">{{ $author->name }}</a></h5>
							@endforeach
						@endif

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
