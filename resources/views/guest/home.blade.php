@extends("layouts.guest")

@section('content')
    
    <!-- elenco immagini -->
    <div class="carousel" data-interval="5000">    
            
            <div class="carousel-track"> <!-- contenitore immagini -->
                <div class="carousel-slide">
                    <img src="{{ asset('images/slider/1.png') }}"> <!-- 1 -->
                </div>

                <div class="carousel-slide">
                    <img src="{{ asset('images/slider/2.png') }}"> <!-- 2 -->
                </div>

                <div class="carousel-slide">
                    <img src="{{ asset('images/slider/3.png') }}"> <!-- 3 -->
                </div>

                <div class="carousel-slide">
                    <img src="{{ asset('images/slider/4.png') }}"> <!-- 4 -->
                </div>
            </div>

            <a class="carousel-button prev" type="button"></a> <!-- indietro -->
            <a class="carousel-button next" type="button"></a> <!-- avanti -->

            <div class="carousel-dots"></div> <!-- pallini -->
    </div>
 

    <!-- testo sotto carosello -->
    <section class="text-section">    
        <h1 class="title">Hai un elettrodomestico smart che non collabora? FixHub ti semplifica la vita.</h1>
        <p class="text"> 
            Da noi trovi soluzioni immediate e tecnici formati che sapranno darti indicazioni pratiche per supportarti in qualunque tuo problema e richiesta.<br><br>Dalla diagnosi al supporto: tutto in un unico posto.
        </p>
    </section>


    <!-- collegamento catalogo -->
    <section class="catalog-section">
        <div class="catalog-top">
            <a class="button catalog-button" href="{{ route('catalog') }}"> Vai al catalogo -></a> 
        </div>

        <div class="catalog-categories">
            <div class="catalog-slide">
                    <img src="{{ asset('images/categories/computer.png') }}"> <!-- Computer -->
                    <a class="selected" href="{{ route('catalog') }}">Computer</a> 
            </div>
            <div class="catalog-slide">
                    <img src="{{ asset('images/categories/phone.png') }}"> <!-- Telefoni e Tablet -->
                    <a class="selected" href="{{ route('catalog') }}">Telefoni e tablet</a> 
            </div>
            <div class="catalog-slide">
                    <img src="{{ asset('images/categories/scanner.png') }}"> <!-- Stampanti -->
                    <a class="selected" href="{{ route('catalog') }}">Stampanti e Scanner</a>
            </div>
            <div class="catalog-slide">
                    <img src="{{ asset('images/categories/console.png') }}"> <!-- Console -->
                    <a class="selected" href="{{ route('catalog') }}">Console e Gaming</a>
            </div>
            <div class="catalog-slide">
                    <img src="{{ asset('images/categories/wifi.png') }}"> <!-- Wi-Fi -->
                    <a class="selected" href="{{ route('catalog') }}">Wi-Fi</a>
            </div>
        </div>
    </section>    
@endsection