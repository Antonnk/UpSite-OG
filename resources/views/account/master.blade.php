<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-grey-lightest font-sans min-h-screen account">
    <div id="root">
        <header class="bg-blue py-4"> 
            <div class="container mx-auto flex items-center">
                <a href="{{ route('account.index') }}">
                    @include('landing.logo-negative')
                </a>
                @include('account.partials.navbar')
            </div>
        </header>

        <main class="py-4 container mx-auto">
            @hasSection('title')
                <h1 class="text-blue my-8">@yield('title')</h1>
            @endif
            <section class="bg-white text-blue p-6 rounded shadow">
                @yield('content')
            </section>
        </main>
    </div>
</body>
</html>
