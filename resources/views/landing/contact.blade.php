@extends('landing.master')

@section('title', 'Kontakt')

@section('content')
	<main class="flex flex-col md:flex-row">
		<section class="leading-normal text-blue px-8 mb-8 w-full md:w-1/2">
			<h2 class="mb-2">Ingen dumme spørgsmål</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, in et distinctio aliquam quod nobis, voluptatum nulla accusantium maiores, ad quasi rem. Libero dignissimos accusantium est, tempora error provident similique.</p>
		</section>
		<contact-form action="{{ route('contact.send') }}" class="w-full md:w-1/2 px-8"></contact-form>
	</main>
@endsection

