@extends('landing.master')

@section('title', 'Kontakt')

@section('content')
	<main class="flex flex-col md:flex-row">
		<section class="leading-normal text-blue px-8 mb-8 w-full md:w-1/2">
			<h2 class="mb-2">Ingen dumme spørgsmål</h2>
			<p>Har du noget du vil spørge om? Eller bare sige UpSite er mega cool.<br>Så er du altid velkommen til at sende os en beksed.<br>Vi svare altid hurtigtst muligt, gerne inden for 24 timer.</p>
		</section>
		<contact-form action="{{ route('contact.send') }}" class="w-full md:w-1/2 px-8"></contact-form>
	</main>
@endsection

