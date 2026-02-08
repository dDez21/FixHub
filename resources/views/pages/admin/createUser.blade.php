@extends("layouts.mainLayout")


@section('content')

<!-- card nuovo utente -->
<div class="card user-space">

    <!-- sezione form -->
    <form method="POST" action="{{ route('admin.users.store') }}" class="create-user-form">
        @csrf

        <!-- nome -->
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" required>
        </div>

        <!-- cognome -->
        <div class="form-group">
            <label for="surname">Cognome</label>
            <input type="text" id="surname" name="surname" required>
        </div>

        <!-- username -->
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>

        <!-- password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <!-- ruolo -->
        <select class="form-group" name="role" id="role" required>
            <option class="role-value" value="tech">Tecnico</option>
            <option class="role-value" value="staff">Staff</option>
            <option class="role-value" value="admin">Admin</option>
        </select>


        @if (old('role') == 'tech')

            <!-- se tecnico -->
            <div id="tech-options">

                <!-- data di nascita -->
                <div class="form-group">
                    <label for="birth_date">Data di nascita</label>
                    <input type="date" id="birth_date" name="birth_date" required>
                </div>


                <!-- centro -->
                <div class="form-group">
                    <label for="center">Centro</label>
                    <select name="center" id="center">
                        <option value="">Seleziona un centro</option>
                        @foreach($centers as $center)
                            <option class="center-value" value="{{ $center->id }}">{{ $center->name }}, {{ $center->city }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- categorie -->
                <div class="form-group">
                    <label for="categories">Categorie</label>
                    <select name="categories[]" id="categories">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    </form>
</div>
    
<!-- conferma creazione -->
<div class="form-confirm">
    <button type="submit" class="button button-confirm">Crea utente</button>
</div>
    
@endsection