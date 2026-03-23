@extends("layouts.mainLayout")

@section('content')
    
    <!-- elenco immagini -->
    <div class="carousel">    
            
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

            <button class="carousel-button prev" type="button"></button> <!-- indietro -->
            <button class="carousel-button next" type="button"></button> <!-- avanti -->
    </div>
 

    <!-- testo sotto carosello -->
    <section class="text-section">    
        <h1 class="title">Hai un elettrodomestico smart che non collabora? FixHub ti semplifica la vita.</h1>
        <p class="text footer-text-margin"> 
            <br>Da noi trovi soluzioni immediate e tecnici formati che sapranno darti indicazioni pratiche per supportarti in qualunque tuo problema e richiesta.<br><br>Dalla diagnosi al supporto: tutto in un unico posto.
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


    <!-- modalità d'accesso sito -->
    <section class="auth-description">

        <!-- titolo descrizione sezione-->
        <div class="upper-section">
            <h1 class="title">Modalità di accesso</h1>
        
            <p class="text footer-text-margin">
            FixHub prevede una parte pubblica accessibile senza autenticazione e una parte riservata accessibile tramite login.
            In base al ruolo assegnato, ogni utente visualizza funzionalità e contenuti differenti.
            </p>
        </div>

        <!-- elenco servizi -->
        <div class="access-categories">
            
            <div class="service-card">
                <h1 class="medium-text-access">Accesso pubblico</h1>

                <p class="small-text">
                    Gli utenti non autenticati possono:<br>
                    - consultare la home page, il catalogo dei prodotti e l'elenco dei nostri centri assistenza<br>
                    - visualizzare le informazioni principali del sito<br>
                    - accedere alla documentazione del progetto
                </p>
            </div>



            <div class="service-card">
                <h1 class="medium-text">Accesso autenticato</h1>

                <p class="small-text">
                    Gli utenti autenticati accedono all’area riservata tramite credenziali personali e hanno a loro disposizione funzionalità disponibili in base al proprio ruolo all'interno dell'azienda.
                </p>
            </div>

        </div>


       <!-- livelli di accesso --> 
        <div class="service-card">
            <h1 class="medium-text">Livelli di accesso</h1>

            <p class="small-text">
                <strong>Tecnico</strong>: visualizzazione delle informazioni del sito e dell’azienda, dell’elenco dei centri di assistenza, del catalogo prodotti e delle relative schede, inclusi malfunzionamenti e soluzioni, senza possibilità di modifica.<br><br>
                <strong>Staff</strong>: gestione dei malfunzionamenti e delle relative soluzioni associate ai prodotti di competenza.<br><br>
                <strong>Admin</strong>: gestione dei prodotti e delle relative informazioni (ad esclusione di malfunzionamenti e soluzioni), amministrazione degli utenti registrati nel sistema e dei centri di assistenza.
            </p>
        </div>
    </section>



<script src="{{ asset('JS/components/carousel.js') }}" defer></script> <!-- per animazione carosello -->
@endsection