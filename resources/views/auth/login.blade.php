@extends('landing.master')

@section('title', 'Login')

@section('content')
<div class="flex flex-col items-center">
    <div class="bg-blue text-white flex-col inline-flex p-8 pt-12 w-full sm:w-1/2 md:w-1/3">
        <form class="flex flex-col items-center" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="w-full mb-3">
                <input id="email" placeholder="Email" type="email" class="input {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="label-error" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="w-full mb-3">
                <input id="password" placeholder="Adgangskode" type="password" class="input {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="label-error" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="w-full mb-8">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Husk mig') }}
                </label>
            </div>
            
            <button type="submit" class="btn bg-yellow">
                {{ __('Log ind') }}
            </button>
        </form>
    </div>
    <a class="mt-3 text-blue-lightest" href="{{ route('password.request') }}">
        {{ __('Glemt dit password?') }}
    </a>
</div>
@endsection
