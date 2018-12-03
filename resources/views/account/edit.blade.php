@extends('account.master')

@section('title', "Rediger dine Oplysninger")

@section('content')
	<form action="{{ route('account.update') }}" method="POST" class="py-3">
		@csrf
		<div class="flex mb-4">
			
			<div class="w-full md:w-1/3 pr-3 pb-3">
				<label for="name">Navn</label>
				<input class="input border" type="text" name="name" id="name" value="{{ $user->name }}" required>
				@if ($errors->has('name'))
                    <span class="label-error" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
			</div>

			<div class="w-full md:w-1/3 pr-3 pb-3">
				<label for="email">Email</label>
				<input class="input border" type="email" name="email" id="email" value="{{ $user->email }}" required>
				@if ($errors->has('email'))
                    <span class="label-error" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
			</div>
		</div>
		<div class="flex mb-4">

			<div class="w-full md:w-1/3 pr-3 pb-3">
				<label for="password">Ny Adgangskode</label>
				<input class="input border" type="password" name="password" id="password">
				@if ($errors->has('password'))
                    <span class="label-error" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
			</div>
			
			<div class="w-full md:w-1/3 pr-3 pb-3">
				<label for="password_confirmation">Bekræft Ny Adgangskode</label>
				<input class="input border" type="password" name="password_confirmation" id="password_confirmation"/>
			</div>
		</div>
		<div class="flex mb-4">
			<button class="btn mr-3" type="submit">Gem Oplysninger</button>
			<a href="{{ route('account.index') }}" class="btn btn-white mr-3">Annuller</a>
		</div>
	</form>
@endSection