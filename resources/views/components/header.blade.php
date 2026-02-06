<header class="site-header">

        <!-- logo e nome -->
        <div class="header-left">
            <img class="header-logo" src="{{ asset('images/logo.png') }}" alt="FixHub">
        </div>

        <!-- pagine selezionabili -->
        <div class="header-center">
            @foreach($navLinks as $link)
                <a class="selected" href="{{ url($link['path']) }}">{{ $link['label'] }}</a>
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
</header>





