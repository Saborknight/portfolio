@extends('layouts.app')

@section('content')
<div class="container" data-section="projects-single">
	<div class="row">
		<div class="col-xs-12">
			<header class="header-project">
				<div class="tag-wrapper-project">
					@if (count($project->categories))
						@php
							$i = 0;
							$leng = count($project->categories);
						@endphp
						@foreach ($project->categories as $category)
							<h4 class="tag-project" data-category-color="{{ $category->color }}">
								<a href="{{ \URL::route('projects', ['category' => $category->name]) }}">{{ ucwords($category->name) }}</a>
							</h4>
							@php
								$i++;
							@endphp
							@if ($i > 0 && $i == $leng - 1)
								<span class="separator-project"> &middot; </span>
							@endif
						@endforeach
					@endif
				</div>

				<h1 class="heading-project">{{ $project->name }}</h1>
				<h2 class="heading-project"><a href="{{ \URL::route('about') }}">{{ $project->authors()->first()->name }}</a></h2>
				<h4 class="heading-project">{{ $project->start_date->format('F Y') }} - {{ $project->end_date ? $project->end_date->format('F Y') : 'On-going' }}</h4>
			</header>

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

					<script>
						// var tag = document.createElement('script');

						// tag.src = "https://www.youtube.com/iframe_api";
						// var firstScriptTag = document.getElementsByTagName('script')[0];
						// firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
					</script>

				{{-- Show us a normal image... --}}
				@else
					<div class="featured-image-project"><img src="{{ URL::asset('images/' . $featured) }}" alt="{{ $project->name }}" width="960" height="400"></div>
				@endif
			@endif

			<article class="parse-area-project">
				@php
					$parse = new Parsedown;

					echo $parse->text($project->body);
				@endphp
			</article>
		</div>
	</div>
</div>

@endsection
