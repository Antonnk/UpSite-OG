<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="cloudinary_cloud_name" content="di0tb2zrz">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta property="og:url"                content="{{ $site->url() }}" />
        <meta property="og:type"               content="business.business" />
        <meta property="og:title"              content="{{ $site->name }}" />
        <meta property="og:description"        content="{{ $site->description }}" />
        <meta property="og:image"              content="{{ $site->coverImageurl }}" />
        <meta property="business:contact_data:street_address" content="{{ $site->addressString() }}" /> 
        <meta property="business:contact_data:email " content="{{ $site->content['contact']['email'] }}" /> 
        <meta property="business:contact_data:phone_number" content="{{ $site->content['contact']['phone'] }}" /> 
        <meta property="business:contact_data:website" content="{{ $site->url() }}" /> 

        @foreach($site->openhours['weekdays'] as $day) 
            @if($day['open'] != null)
                <meta property="business:hours:day" content="{{ $day['name'] }}" />
                <meta property="business:hours:start" content="{{ $day['open'] }}" />
                <meta property="business:hours:end" content="{{ $day['close'] }}" />
            @endif
        @endforeach
        
        <meta name="description" content="{{ $site->description }}">
        <link rel="manifest" href="/manifest.json">
        
        <link rel="stylesheet" href="{{ mix("css/$theme.css") }}">
        <title>{{ $site->name }}</title>
    </head>
    <body>
        
        <div id="root">
            <site-render init-theme="{{ studly_case($theme) }}" :content='@json($site->content)' :openhours='@json($site->openhours)'></site-render>
        </div>

        <script type="application/ld+json">
          @json($structuredData)
        </script>

        <script src="{{ mix('js/render.js') }}"></script>
    </body>
</html>
 