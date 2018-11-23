<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="cloudinary_cloud_name" content="di0tb2zrz">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class=" font-sans @yield('body-class')">
    <div id="root">
        <div class="min-h-screen">
            <header class="container flex mx-auto relative z-50 py-8 mb-8">
                <h2 title="Upsite">
                    <a href="/">
                        <span class="hidden">UpSite</span>
                        @include('landing.logo')
                    </a>
                </h2>
                
                <nav class="flex-1 main-nav">
                    <ul class="flex justify-end list-reset text-blue font-medium">
                        <li class="{{ request()->is('priser') ? 'active' : '' }}">
                            <a class="ml-8 no-underline text-blue" href="{{ route('pricing') }}">Priser</a>
                        </li>
                        <li>
                            <a class="ml-8 no-underline text-blue" href="">Kontakt</a>
                        </li>
                        <li>
                            <a class="ml-8 no-underline text-blue" href="{{ route('login') }}">Log ind</a>
                        </li>
                    </ul>
                </nav>
            </header>
            
            @hasSection('title')
                <h1 class="mb-16 text-5xl text-blue text-center">@yield('title')</h1>
            @endif

            @hasSection('content')
                <div class="container mx-auto">
                    @yield('content')
                </div>
            @endif

            @yield('full-content')
        </div>

        @include('landing.footer')
    </div>
    <script src="{{ mix('js/landing.js') }}"></script>
</body>
</html>