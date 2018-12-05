<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="cloudinary_cloud_name" content="di0tb2zrz">

    {{-- Favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#00a300">
    <meta name="theme-color" content="#ffffff">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="Opret en synlig & brugervenlig hjemmeside på under 5 minutter! Ingen teknisk viden påkrævet.">
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link async href="https://fonts.googleapis.com/css?family=Poppins:400,400i,500,500i,600,600i,700,700i,800,900" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link async href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class=" font-sans @yield('body-class')">
    <div id="root">
        <div class="min-h-screen">
            <header class="container flex mx-auto relative z-50 py-8 mb-8 md:px-0 px-6">
                <h2 title="Upsite">
                    <a href="/" title="home">
                        <span class="hidden">UpSite</span>
                        @include('landing.logo')
                    </a>
                </h2>
                
                <nav class="flex-1 flex justify-end main-nav">
                    {{-- flex justify-end list-reset text-blue font-medium --}}
                    <button @click="menuVisable = !menuVisable" class="flex font-bold items-center md:hidden text-blue text-lg">
                        <svg class="fill-current mr-1 text-blue w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                        Menu
                    </button>
                    <button @click="menuVisable = !menuVisable" v-show="menuVisable" class="z-50 px-2 flex font-bold items-center md:hidden text-blue text-3xl">&times;</button>
                    <ul :class="{ 'flex' : menuVisable }" class="pin bg-yellow fixed md:relative md:bg-transparent md:flex-row md:text-base md:font-medium md:justify-end md:flex hidden justify-center font-bold flex-col items-center list-reset text-3xl text-blue">
                        <li class="mb-8 md:mb-0 {{ request()->url() == route('build.overview') ? 'active' : '' }}">
                            <a class="ml-0 md:ml-8 no-underline text-blue" href="{{ route('build.overview') }}">Byg din side</a>
                        </li>
                        <li class="mb-8 md:mb-0 {{ request()->url() == route('pricing') ? 'active' : '' }}">
                            <a class="ml-0 md:ml-8 no-underline text-blue" href="{{ route('pricing') }}">Priser</a>
                        </li>
                        <li class="mb-8 md:mb-0 {{ request()->url() == route('contact') ? 'active' : '' }}">
                            <a class="ml-0 md:ml-8 no-underline text-blue" href="{{ route('contact') }}">Kontakt</a>
                        </li>
                        @if (Auth::check())
                            <li class="mb-8 md:mb-0 {{ request()->url() == route('account.index') ? 'active' : '' }}">
                                <a class="ml-0 md:ml-8 no-underline text-blue" href="{{ route('account.index') }}">Konto</a>
                            </li>
                        @else
                            <li class="mb-8 md:mb-0 {{ request()->url() == route('login') ? 'active' : '' }}">
                                <a class="ml-0 md:ml-8 no-underline text-blue" href="{{ route('login') }}">Log ind</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </header>
            
            @hasSection('title')
                <h1 class="mb-16 text-5xl text-blue text-center">@yield('title')</h1>
            @endif

            @hasSection('content')
                <div class="container mx-auto md:px-0 px-6">
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