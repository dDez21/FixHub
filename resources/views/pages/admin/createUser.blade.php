@extends("layouts.mainLayout")


@section('content')

<!-- card nuovo utente -->
<div class="card user-space">

    <!-- sezione form -->
    <form method="POST" action="{{ route('admin.users.store') }}" class="create-user-form">
        @csrf

        <!-- nome -->
        <div class="form-space">
            <label class="form-label" for="name">Nome</label>
            <input class="form-input" type="text" id="name" name="name" required>
        </div>

        <!-- cognome -->
        <div class="form-space">
            <label class="form-label" for="surname">Cognome</label>
            <input class="form-input"type="text" id="surname" name="surname" required>
        </div>

        <!-- username -->
        <div class="form-space">
            <label class="form-label" for="username">Username</label>
            <input class="form-input"type="text" id="username" name="username" required>
        </div>

        <!-- password -->
        <div class="form-space">
            <label class="form-label" for="password">Password</label>
            <input class="form-input" type="password" id="password" name="password" required>
        </div>

        <!-- ruolo -->
        <select class="form-group" name="role" id="role" required>
            <option class="role-value" value="tech"  @selected(old('role')=='tech')>Tecnico</option>
            <option class="role-value" value="staff" @selected(old('role')=='staff')>Staff</option>
            <option class="role-value" value="admin" @selected(old('role')=='admin')>Admin</option>
        </select>



        <!-- se tecnico -->
        @php
            $isTech = old('role', 'tech') === 'tech';
        @endphp

            
            <div id="tech-options">

                <!-- data di nascita -->
                <div class="form-group">
                    <label class="form-label" for="birth_date">Data di nascita</label>
                    <input class="form-input"type="date" id="birth_date" name="birth_date" required>
                </div>


                <!-- centro associato -->
                <div class="form-group">
                    <label class="form-label" for="center">Centro</label>
                    <select name="center" id="center">
                        <option value="">Seleziona un centro</option>
                        @foreach($centers as $center)
                            <option class="center-value" value="{{ $center->id }}">{{ $center->name }}, {{ $center->city }}</option>
                        @endforeach
                    </select>
                </div>


                <!-- categorie -->
                <div class="form-group">
                    <label class="form-label" for="categories">Categorie</label>
                    <select name="categories[]" id="categories" multiple>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>   
</div>
    
        <!-- conferma creazione -->
        <div class="form-confirm">
            <button type="submit" class="button button-confirm">Crea utente</button>
        </div>
    </form>

<script src="{{ asset('js/new-user-tech.js') }}"></script>
@endsection