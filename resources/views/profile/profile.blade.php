@extends("layouts.mainLayout")

@section('content') 
    
    <!-- info profilo utente -->
    <div class="card profile-card">
        
        <h1 class="text profile">Il tuo profilo</h1>

        <div class="profile-info">
            <!-- info utente loggato -->
            <p><strong>Nome:</strong> {{ $user->name }}</p>
            <p><strong>Cognome:</strong> {{ $user->surname }}</p>
            <p><strong>Username:</strong> {{ $user->username }}</p>


        
            <!-- se utente loggato è tecnico -->
            @if($isTech && $user->tech)
                
                <!-- data di nascita -->
                <p><strong>Data di nascita:</strong> {{ $user->tech->birth_date }} </p>
                
                <!-- categorie associate -->
                @php
                    $catNames = $user->categories->pluck('name')->implode('  -  ');
                @endphp
                <p><strong>Categorie:</strong> {{ $catNames ?: '  -  ' }}</p>
                
                <!-- centro associato -->
                <p><strong>Centro associato:</strong>
                    {{ $user->tech->center->name ?? '-' }} -
                    {{ $user->tech->center->street ?? '' }} {{ $user->tech->center->civic ?? '' }},
                    {{ $user->tech->center?->city?->name ?? '' }}
                </p>   
            @endif

            <!-- se utente loggato è staff -->
            @if($isStaff)
                @php
                    $catNames = $user->categories->pluck('name')->implode('  -  ');
                @endphp

                <p><strong>Categorie:</strong> {{ $catNames ?: '  -  ' }}</p>
            @endif
            
        </div>
    </div>

    <!-- logout -->
    <div class="logout-container">    
        <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="button button-logout">Logout</button>
        </form>
    </div>
@endsection