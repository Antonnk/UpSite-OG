<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="cloudinary_cloud_name" content="di0tb2zrz">
        <link rel="stylesheet" href="{{ $styleSheetPath }}">
        <title>{{ config('app.name', 'Laravel') }} - Byg din side</title>
    </head>
    <body>
        <div id="root">
            <site-builder init-theme="{{ studly_case($theme) }}" :content="{{ json_encode($content) }}"></site-builder>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
 