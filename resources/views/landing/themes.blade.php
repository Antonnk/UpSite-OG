@extends('landing.master')

@section('title', 'Vælg en skabelon')

@section('content')
	<div class="flex justify-center flex-wrap">
		@foreach($themes as $theme)
		<div class="w-full md:w-1/3 lg:w-1/4 px-3 mb-6">
			<a class="bg-white rounded shadow no-underline text-blue block h-full" href="{{ route('build', $theme->slug) }}">
				<cl-image class="rounded-t bg-center h-32" public-id="{{ $theme->coverImage }}" :options="{crop: 'fill', width: 400, height: 200 }">
					<i></i>
				</cl-image>
				<div class="px-3 pb-3"> 
					<h2 class="my-1 text-xl">{{ $theme->name }}</h2>
					<p class="text-sm">{{ str_limit($theme->description, 100) }}</p>
				</div>
			</a>
		</div>
		@endforeach
	</div>
@endsection

