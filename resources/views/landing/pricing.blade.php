@extends('landing.master')

@section('title', 'Overskuelige priser!')

@section('content')
	<main class="flex items-baseline justify-center">
		<div class="inline-flex">
			<div class="pt-10">
				<div class="bg-yellow text-blue p-6">
					<i>Startpakken</i>
					<h2 class="text-4xl font-black">Gratis</h2>
					<hr class="border-2 border-blue">
					<ul class="list-reset py-2 leading-loose font-medium">
						<li>Hjemmeside</li>
						<li>Twitter links</li>
						<li>Facebook links </li>
						<li>Grundlægende SEO</li>
						<li>Google local Business</li>
						<li>Grundlægende analyse værktøjer</li>
					</ul>
					<div class="flex justify-center mt-4">
						<a class="btn" href="{{ route('register') }}">Opret konto</a>
					</div>
				</div>
				<small class="text-blue-lightest block text-center py-2 text-sm font-semibold">Du kan altid opgradere<br> til professionel</small>
			</div>
			<div class="bg-blue flex flex-col justify-between px-6 py-8 text-white">
				<div>
					<i>Professionel</i>
					<h2 class="text-4xl font-black">100 kr/md</h2>
					<hr class="border-2 border-white mb-4">
					<b class="text-yellow">Du får alt hvad der er i startpakken +</b>
					<ul class="list-reset py-2 leading-loose font-medium">
						<li>Tilpasset domæne </li>
						<li>Kontakt formular</li>
						<li>Nyhedsbrev tilmelding</li>
						<li>Udvidet analyse værktøjer</li>
						<li>Gratis support</li>
						<li>Adgang til Plus-skabeloner</li>
						<li>Adgang til alle nye features</li>
					</ul>
				</div>
				<div class="flex justify-center">
					<a class="btn btn-white" href="{{ route('register') }}">Opret konto</a>
				</div>
			</div>
		</div>
	</main>
@endsection

