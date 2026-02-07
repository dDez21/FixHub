@extends("layouts.mainLayout")


@section('content')

<!-- card utenti -->
<div class="card">
            
    <!-- scroller verticale -->
    <div class="users" role="list">
                
        @forelse ($users as $user)
                    
            <!-- prendo dati ogni utente-->
            <div class="user-single" role="button" tabindex="0"
                data-name="{{ $user->name }}"
                data-address="{{ $user->surname }}"
                data-civic="{{ $user->role }}"
                data-city="{{ $user->username }}"
                data-phone="{{ $user->password }}"> 

                <!-- dati mostrati nell'elenco centri -->
                <p class="medium-text center-item">{{ $user->name }} {{ $user->surname }}</p>
                
                <!-- ruolo utente -->
                <p class="medium-text center-item">
                    @if($user->role == 'admin')Admin
                    @elseif($user->role == 'tech')Tecnico
                    @elseif($user->role == 'staff')Staff
                    @endif
                </p>
            </div>

        @empty
        @endforelse
    </div>
</div>


    <!-- dettagli utente selezionato -->
    <div class="card card-user-data" id="user-data"> <!-- la mostro solo quando ho un utente selezionato -->
    
        <!-- nome utente -->
        <div class="user-item title">
                    <h1 class="user-item title" id="user-name"></h1> 
                    <h1 class="user-item title" id="user-surname"></h1>
        </div> 
        
        <!-- nome utente -->
        <p class="user-item medium-text" id="user-role"></p>
        <p class="user-item medium-text" id="user-username"></p>
        <p class="user-item medium-text" id="user-password"></p>
    </div> 
    
    
</div>

<script src="{{ asset('JS/pages/users-data.js') }}" defer></script>
@endsection