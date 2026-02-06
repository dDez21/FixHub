<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        
        <title>{{ config('app.name', 'FixHub') }}</title>

        <!-- stili testi -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> 
        
        
        <link rel="icon" type="image/png" href="{{ asset('icon/browIcon.png') }}"> <!-- logo browser tab -->


        <!-- Scripts -->
        <link rel="stylesheet" href="{{ asset(path: 'css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/components/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/views/home.css') }}">
        <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/views/where.css') }}">
        <link rel="stylesheet" href="{{ asset('css/views/catalog.css') }}">
        <link rel="stylesheet" href="{{ asset('css/views/user.css') }}">
        <link rel="stylesheet" href="{{ asset('css/components/card.css') }}">
        <link rel="stylesheet" href="{{ asset('css/components/button.css') }}">
        <link rel="stylesheet" href="{{ asset('css/components/form.css') }}">
    </head>

    <body>
        @include('components.header') <!-- header -->
        
        <main class="page">
            @yield("content") <!-- contenuto principale -->
        </main>            
        
        <script src="{{ asset('JS/components/carousel.js') }}" defer></script> <!-- animazione carosello -->

        <script src="{{ asset('JS/components/filter_products.js') }}" defer></script> <!-- barra di ricerca -->

        @include('components.footer')
    </body>
</html>
