@extends('landing.master')

@section('title', 'Stærkt!')

@section('content')
    <div class="flex items-start justify-center w-4/5 mx-auto my-12">
        @if($site)
            <div class="text-blue flex-col inline-flex p-8 py-12 w-1/2">
                <h2 class="font-bold mb-6 text-xl">@lang('register.with_site_1')</h2>
                <div class="border border-blue flex">
                    <div class="w-64">
                        <cl-image class="bg-center bg-cover bg-no-repeat h-full" public-id="{{ $site->coverImage }}" :options="{width: 100, height: 300, crop: 'fill'}">
                            <i></i>
                        </cl-image>
                    </div>
                    <div class="px-4 py-6">
                        <b class="block mb-2 text-lg">{{ $site->name }}</b>
                        <p class="mb-2">{{ str_limit($site->content['intro'], 75, '...') }}</p>
                        <p class="font-medium">
                            {{ $site->content['contact']['address'] }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-blue text-white flex-col inline-flex p-8 py-12 w-1/2">
        
            <h2 class="font-bold mb-6 text-lg">@lang('register.with_site_2')</h2>

            <form class="flex flex-col items-center" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="w-full mb-3">
                    <input id="name" placeholder="{{ __('Navn') }}" type="text" class="input {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="label-error" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="w-full mb-3">                
                    <input id="email" placeholder="{{ __('Email') }}" type="email" class="input {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="label-error" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="w-full mb-3">
                    <input id="password" placeholder="{{ __('Adgangskode') }}" type="password" class="input {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="label-error" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <input id="password-confirm" placeholder="{{ __('Gentag adgangskode') }}" type="password" class="input mb-6" name="password_confirmation" required>

                
                <button type="submit" class="btn bg-yellow">
                    @lang('register.create_account')
                </button>
            </form>
        </div>
    </div>
@endsection
