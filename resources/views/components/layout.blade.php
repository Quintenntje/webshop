<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {!! \Artesaos\SEOTools\Facades\SEOTools::generate() !!}

        <!-- Styles / Scripts -->
        <script defer src="https://analytics.quintenclaes.be/script.js" data-website-id="1610ff79-51f0-4c0c-aef0-13c39dd2ecc3"></script>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
        @endif
    </head>
    <body>
        @include('partials.nav')
        <main>
           {{ $slot }}
        </main>
        @include('partials.footer')
    </body>
</html>
