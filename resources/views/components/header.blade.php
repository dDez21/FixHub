<header class="site-header">

    <div class="header-info">
        
        <!-- logo e documentazione -->
        <div class="header-left">
            <!-- logo -->
            <div class="header-logo-space">
                <img class="header-logo" src="{{ asset('images/logo.png') }}" alt="FixHub">
            </div>

            <!-- documento -->
            <div class="header-description-space">
                Per visualizzare la documentazione     
                <strong><a href="{{ asset('docs\relazione_progetto.pdf') }}" class="alert-link">clicca qui!</a></strong>
            </div>
        </div>
            
        <!-- pagine selezionabili -->
        <div class="header-center">
                
            <!-- gestione quali mostrare in Providers -->
            @foreach($navLinks as $link)
                <a class="selected" href="{{ isset($link['route']) ? route($link['route']) : url($link['path']) }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>
        

        <!-- sezione login -->
        <div class="header-right">
            @guest
                <a class="button button-login" href="{{ route('login') }}">Login</a>
            @endguest


            @auth
                <a class="button button-login" href="{{ route('profile') }}">
                    {{ auth()->user()->username }}
                    <img class="button-icon" src="{{ asset('icon/userIcon.png') }}" alt="" aria-hidden="true">
                </a>            
            @endauth
        </div>
    </div>
</header>





