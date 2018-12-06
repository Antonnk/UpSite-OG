@extends('account.master')

@section('title', "Velkommen, $user->name")

@section('content')
	@if($user->site)
	<div class="flex flex-col md:flex-row">
		<div class="w-full md:w-1/2 mr-8">
			<i class="font-extrabold opacity-25 tracking-wide uppercase">Din side</i>
			<h2 class="mb-2 text-3xl">{{ $user->site->name }}</h2>
			<b class="break-words">{{ $user->site->title }}</b>
			<p class="mb-6 break-words">{{ $user->site->description }}</p>
			<div>
				<a class="btn btn-sm mr-2" target="_blank" href="{{ route('site.edit', $user->site->slug) }}">Rediger side</a>
				<a class="btn btn-sm btn-white border" target="_blank" rel="noopener" href="{{ $user->site->url() }}">Se side</a>
			</div>
		</div>
		<div class="w-full md:w-1/2">
			<i class="font-extrabold opacity-25 tracking-wide uppercase">Adresse</i>
			<p class="mb-3">
				{{ $user->site->content['contact']['address']['street'] }}<br>
				{{ $user->site->content['contact']['address']['postcode'] }} {{ $user->site->content['contact']['address']['city'] }}
			</p>

			<i class="font-extrabold opacity-25 tracking-wide uppercase">Firma Telefon</i>
			<p class="mb-3">{{ $user->site->content['contact']['phone'] }}</p>

			<i class="font-extrabold opacity-25 tracking-wide uppercase">Firma Email</i>
			<p class="mb-3">{{ $user->site->content['contact']['email'] }}</p>

			<i class="font-extrabold opacity-25 tracking-wide uppercase">Åbningstider</i>
			<ul class="list-reset w-64">
				@foreach($user->site->weekdays as $day)
					<li class="flex mb-1">
						<p class="flex-1">{{ $day['name'] }}</p>
						@if($day['open'] == null)
							<b>Lukket</b>
						@else
							<b class="text-right">{{ $day['open'] }} - {{ $day['close'] }}</b>
						@endif
					</li>
				@endforeach
			</ul>
		</div>
	</div>
	@else
	<div class="flex flex-col items-center justify-center">
		<span class="text-5xl">😯</span>
		<b class="text-xl opacity-75 mb-4">Du har ikke nogen side</b>
		<a class="btn" href="{{ route('build.overview') }}">Opret en side</a>
	</div>
	@endif
@endSection