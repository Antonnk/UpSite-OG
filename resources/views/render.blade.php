<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="cloudinary_cloud_name" content="di0tb2zrz">
        
        <meta name="description" content="{{ $site->description }}">
        <link rel="manifest" href="/manifest.json">
        
        <link rel="stylesheet" href="{{ mix("css/$theme.css") }}">
        <title>{{ $site->name }}</title>
    </head>
    <body>
        <div id="root">
            <site-render init-theme="{{ studly_case($theme) }}" :content="{{ json_encode($site->content) }}"></site-render>
        </div>
        <script type="application/ld+json">
          @json($structuredData)
        </script>

        <script src="{{ mix('js/render.js') }}"></script>
    </body>
</html>
 