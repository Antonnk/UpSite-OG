@extends('landing.master')

@section('title', 'Vælg en skabelon')

@section('content')
	<div class="flex">
		@foreach($themes as $theme)
		<div class="px-3 w-1/5">
			<a class="bg-white rounded shadow no-underline text-blue block h-full" href="{{ route('build', $theme->slug) }}">
				<cl-image class="rounded-t" public-id="{{ $theme->coverImage }}" :options="{crop: 'fill', width: 400, height: 200 }"></cl-image>
				<div class="px-3 pb-3"> 
					<h2 class="my-1 text-xl">{{ $theme->name }}</h2>
					<p class="text-sm">{{ str_limit($theme->description, 100) }}</p>
				</div>
			</a>
		</div>
		@endforeach
	</div>
@endsection

