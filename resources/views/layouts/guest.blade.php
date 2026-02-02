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
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('CSS/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('CSS/header.css') }}">
        <link rel="stylesheet" href="{{ asset('CSS/guest.css') }}">
        <link rel="stylesheet" href="{{ asset('CSS/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('CSS/components/button.css') }}">
        <link rel="stylesheet" href="{{ asset('CSS/components/form.css') }}">
    </head>

    <body>
        @include('components.header') <!-- header -->
        
        <main class="page">
            @yield("content") <!-- contenuto principale -->
        </main>            
        
        <script src="{{ asset('JS/components/carousel.js') }}" defer></script> <!-- animazione carosello -->

        @include('components.footer')
    </body>
</html>
