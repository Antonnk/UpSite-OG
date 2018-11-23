@extends('account.master')

@section('title', "Rediger dine Oplysninger")

@section('content')
	<form action="" class="py-3">
		<div class="flex mb-4">
			<div class="w-full md:w-1/3 pr-3 pb-3">
				<label for="name">Navn</label>
				<input class="input border" type="text" name="name" id="name" value="{{ $user->name }}" required>
			</div>
			<div class="w-full md:w-1/3 pr-3 pb-3">
				<label for="email">Email</label>
				<input class="input border" type="email" name="email" id="email" value="{{ $user->email }}" required>
			</div>
		</div>
		<div class="flex mb-4">
			<div class="w-full md:w-1/3 pr-3 pb-3">
				<label for="password">Adgangskode</label>
				<input class="input border" type="password" name="password" id="password">
			</div>
			<div class="w-full md:w-1/3 pr-3 pb-3">
				<label for="password_confirm">Bekræft Adgangskode</label>
				<input class="input border" type="password" name="password_confirm" id="password_confirm"/>
			</div>
		</div>
		<div class="flex mb-4">
			<button class="btn mr-3" type="submit">Gem Oplysninger</button>
		</div>
	</form>
@endSection