@extends('account.master')

@section('title', "Velkommen, $user->name")

@section('content')
	@if($user->site)
	<div class="flex flex-col md:flex-row">
		<div class="w-full md:w-1/2 mr-8">
			<i class="font-extrabold opacity-25 tracking-wide uppercase">Din side</i>
			<h2 class="mb-1">{{ $user->site->name }}</h2>
			<p class="mb-6">{{ $user->site->description }}</p>
		</div>
		<div class="w-full md:w-1/2">
			<i class="font-extrabold opacity-25 tracking-wide uppercase">Adresse</i>
			<p class="mb-3">{{ $user->site->content['contact']['address'] }}</p>

			<i class="font-extrabold opacity-25 tracking-wide uppercase">Telefon</i>
			<p class="mb-3">{{ $user->site->content['contact']['phone'] }}</p>

			<i class="font-extrabold opacity-25 tracking-wide uppercase">Email</i>
			<p class="mb-3">{{ $user->site->content['contact']['email'] }}</p>
		</div>
	</div>
	<div>
		<a class="btn btn-sm mr-2" href="">Rediger side</a>
		<a class="btn btn-sm btn-white border" target="_blank" rel="noopener" href="{{ $user->site->url() }}">Se side</a>
	</div>
	@endif
@endSection