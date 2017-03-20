@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="tag-wrapper-project">
				@if (count($project->categories))
					@foreach ($project->categories as $category)
						<a href="{{ \URL::route('projects', ['category' => $category->name]) }}">
							<h4 class="tag-project" data-category-color="{{ $category->color }}">{{ ucwords($category->name) }}</h4>
						</a>
					@endforeach
				@endif
			</div>

			<h1 class="heading-project">{{ $project->name }}</h1>
			<h2 class="heading-project"><a href="{{ \URL::route('about') }}">{{ $project->authors()->first()->name }}</a></h2>
			@php
				$sd = Carbon\Carbon::parse($project->start_date);
				$ed = Carbon\Carbon::parse($project->end_date);
			@endphp
			<h4 class="heading-project">{{ $sd->format('F Y') }} - {{ $ed->format('F Y') }}</h4>

			@if (count($project->featured))

				{{-- Show us Vimeo! --}}
				@if (preg_match(
					'/(http:\/\/|https:\/\/|)(player.|www.)?(vimeo\.com)\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/',
					$project->featured))

					<div class="featured-video-project"><iframe src="{{ $project->featured }}" width="1280" height="720" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>

				{{-- Show us Youtube! --}}
				@elseif (preg_match(
					'/(http:\/\/|https:\/\/|)(player.|www.)?(youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/',
					$project->featured))

					<div class="featured-video-project"><iframe src="{{ $project->featured }}" width="1280" height="720" frameborder="0" allowfullscreen></iframe></div>

				{{-- Show us a normal image... --}}
				@else
					<div class="featured-image-project"><img src="{{ URL::asset('images/' . $project->featured) }}" alt="{{ $project->name }}" width="960" height="400"></div>
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
