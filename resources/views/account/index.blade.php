@extends('account.master')

@section('title', "Velkommen, $user->name")

@section('content')
	@if($user->site)
	<div class="flex flex-col md:flex-row">
		<div class="w-full md:w-1/2 mr-8">
			<i class="font-extrabold opacity-25 tracking-wide uppercase">Din side</i>
			<h2 class="mb-1">{{ $user->site->name }}</h2>
			<p class="mb-6 break-words">{{ $user->site->description }}</p>
		</div>
		<div class="w-full md:w-1/2">
			<i class="font-extrabold opacity-25 tracking-wide uppercase">Adresse</i>
			<p class="mb-3">{{ strip_tags($user->site->content['contact']['address']) }}</p>

			<i class="font-extrabold opacity-25 tracking-wide uppercase">Telefon</i>
			<p class="mb-3">{{ $user->site->content['contact']['phone'] }}</p>

			<i class="font-extrabold opacity-25 tracking-wide uppercase">Email</i>
			<p class="mb-3">{{ $user->site->content['contact']['email'] }}</p>
		</div>
	</div>
	<div>
		<a class="btn btn-sm mr-2" target="_blank" href="{{ route('site.edit', $user->site->slug) }}">Rediger side</a>
		<a class="btn btn-sm btn-white border" target="_blank" rel="noopener" href="{{ $user->site->url() }}">Se side</a>
	</div>
	@else
	<div class="flex flex-col items-center justify-center">
		<svg class="opacity-50 fill-current mb-3 text-blue w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
		<b class="text-xl opacity-75 mb-4">Du har ikke nogen side</b>
		<a class="btn" href="{{ route('build.overview') }}">Opret en side</a>
	</div>
	@endif
@endSection