@extends("layouts.mainLayout")


@section('content')

<div class="users-layout">

    <div class="users-list">
        <!-- card utenti -->
        <div class="card users-card">
            
            <!-- nuovo utente -->
            <div class="new-element">
                <a class="add-user" href="{{ route('admin.users.createUser') }}">
                    <img class="add-user-icon" src="{{ asset('icon/new.png') }}" alt="">
                </a>
            </div>

            <!-- scroller verticale -->
            <div class="users" role="list">

                @forelse ($users as $user)
                            
                    <!-- prendo dati ogni utente-->
                    <div class="user-single" role="button" tabindex="0"
                        data-name="{{ $user->name }}"
                        data-surname="{{ $user->surname }}"
                        data-role="{{ $user->role }}"
                        data-username="{{ $user->username }}"
                        data-tech-url="{{ route('admin.users.tech', $user) }}">

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
        <div class="user-data-container">
            <div class="card card-user-data" id="user-data"> <!-- la mostro solo quando ho un utente selezionato -->
            
                <!-- nome utente -->
                <div class="user-item-name">
                            <h1 class="user-item title" id="user-name"></h1> 
                            <h1 class="user-item title" id="user-surname"></h1>
                </div> 
                
                <!-- nome utente -->
                <p class="user-item medium-text" id="user-role"></p>
                <p class="user-item medium-text" id="user-username"></p>


                <!-- se tecnico -->
                <div id="tech-data" style="display: none;">
                    <p class="user-item medium-text" id="user-tech-center"></p>
                    <p class="user-item medium-text" id="user-tech-categories"></p>
                </div>

              


                <!-- modifica utente -->
                <div class="new-element">
                    <a class="modify-user" href="{{ route('admin.users.editUser', $user) }}">
                        <img class="add-user-icon" src="{{ asset('icon/edit.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>   
</div>

<script src="{{ asset('JS/pages/users-data.js') }}" defer></script>
@endsection