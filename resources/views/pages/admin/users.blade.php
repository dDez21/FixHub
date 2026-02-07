@extends("layouts.mainLayout")


@section('content')

<div class="users-layout">

    <div class="users-list">
        <!-- card utenti -->
        <div class="card">
                    
            <!-- scroller verticale -->
            <div class="users" role="list">
                        
                @forelse ($users as $user)
                            
                    <!-- prendo dati ogni utente-->
                    <div class="user-single" role="button" tabindex="0"
                        data-name="{{ $user->name }}"
                        data-surname="{{ $user->surname }}"
                        data-role="{{ $user->role }}"
                        data-username="{{ $user->username }}">

                        <!-- dati mostrati nell'elenco centri -->
                        <p class="medium-text user-item">{{ $user->name }} {{ $user->surname }}</p>
                        
                        <!-- ruolo utente -->
                        <p class="small-text user-item"> 
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
    </div>

        <!-- dettagli utente selezionato -->
        <div class="card card-user-data" id="user-data"> <!-- la mostro solo quando ho un utente selezionato -->
        
            <!-- nome utente -->
            <div class="user-item-name">
                        <h1 class="user-item title" id="user-name"></h1> 
                        <h1 class="user-item title" id="user-surname"></h1>
            </div> 
            
            <!-- nome utente -->
            <p class="user-item medium-text" id="user-role"></p>
            <p class="user-item medium-text" id="user-username"></p>
        </div>     
</div>

<script src="{{ asset('JS/pages/users-data.js') }}" defer></script>
@endsection