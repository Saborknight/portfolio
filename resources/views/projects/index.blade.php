@extends('layouts.app')

@section('content')
<div class="container" data-section="projects">
	<div class="row">
		<div class="col-xs-12">
			<h1>My Projects</h1>
		</div>
	</div>

	@if ($projects)
		@foreach ($projects as $project)
			<div class="row project">
				<div class="col-xs-12 col-sm-6">
					<div class="project-featured">
						@if ($featured = $project->featured)

							{{-- Show us Vimeo! --}}
							@if (preg_match(
								'/(http:\/\/|https:\/\/|)(player.|www.)?(vimeo\.com)\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/',
								$featured))

								@php
									if (strpos($featured, '?api=1') === false) {

										if (strpos($featured, '?') === false) {
											$featured = $featured . '?api=1';
										} else {
											$featured = $featured . '&api=1';
										}
									}
								@endphp

								<div class="featured-video-project vimeoPlayer"><iframe src="{{ $featured }}" width="1280" height="720" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>

							{{-- Show us Youtube! --}}
							@elseif (preg_match(
								'/(http:\/\/|https:\/\/|)(player.|www.)?(youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/',
								$featured))

								@php
									if (strpos($featured, '?enablejsapi=1') === false) {

										if (strpos($featured, '?') === false) {
											$featured = $featured . '?enablejsapi=1';
										} else {
											$featured = $featured . '&enablejsapi=1';
										}
									}
								@endphp

								<div class="featured-video-project youtubePlayer"><iframe id="player" src="{{ $featured }}&origin={{ url('/') }}&controls=2" width="1280" height="720" frameborder="0" allowfullscreen></iframe></div>

							{{-- Show us a normal image... --}}
							@else
								<div class="featured-image-project"><img src="{{ URL::asset('images/' . $featured) }}" alt="{{ $project->name }}" width="960" height="400"></div>
							@endif
						@endif
					</div>
				</div>

				<div class="col-xs-12 col-sm-6">
					<div class="project-information">
						<h2>
							<a href="{{ \URL::route('projects.single', ['project' => $project->permalink]) }}">{{ $project->name }}</a>
						</h2>
						{{-- Show Categories --}}
						@if (count($project->categories))
						@php
							$i = 0;
							$leng = count($project->categories);
						@endphp
							<div class="tag-project-wrapper">
								@foreach ($project->categories as $category)
									<h4 class="tag-project" data-category-color="{{ $category->color }}">
										<a href="{{ \URL::route('projects', ['category' => $category->name]) }}">
											{{ ucwords($category->name) }}
										</a>
									</h4>
									@php
										$i++;
									@endphp
									@if ($i > 0 && $i == $leng - 1)
										<span class="separator-project"> &middot; </span>
									@endif
								@endforeach
							</div>
						@endif
						{{-- Show Status if not Published --}}
						{{-- @if ($project->state === 'drafted')
							<span class="state-drafted"><a href="{{ \URL::route('projects.store', ['project' => $project->id]) }}">Draft</a></span>
						@elseif ($project->state === 'archived')
							<span class="state-archived"><a href="{{ \URL::route('projects.store', ['project' => $project->id]) }}">Archived</a></span>
						@endif --}}
						{{-- Show relevant Authors --}}
						{{-- @if (count($project->authors))
							@foreach ($project->authors as $author)
								<h5><a href="{{ url('/about') }}">{{ $author->name }}</a></h5>
							@endforeach
						@endif --}}
						<p>
							@php
								$parse = new Parsedown();
								$body = $parse->text($project->body);
								$body = strip_tags($body);
							@endphp
							@if (strlen($body) >= 200)
								{{ trim (substr ($body, 0, 200), ". \t\n\r\0\x0B") . '...' }}
							@else
								{{ substr ($body, 0, 200) }}
							@endif
						</p>
					</div>
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
