@extends("layouts.mainLayout")


@section('content')

<!-- se tecnico -->
@php $isTech = old('role') === 'tech'; @endphp

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
        <select class="form-space" name="role" id="role" required>
            <label class="form-label" for="role">Ruolo</label>
            <option class="list-value" value="tech"  @selected(old('role')=='tech')>Tecnico</option>
            <option class="list-value" value="staff" @selected(old('role')=='staff')>Staff</option>
            <option class="list-value" value="admin" @selected(old('role')=='admin')>Admin</option>
        </select>


        <!-- opzioni tecnico -->
        <div id="tech-options" @if(!$isTech) hidden @endif>

            <!-- data di nascita -->
            <div class="form-space">
                <label class="form-label" for="birth_date">Data di nascita</label>
                <input class="form-input"type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" max="{{ now()->toDateString() }}">
            </div>


            <!-- centro associato -->
            <div class="form-space">
                <label class="form-label" for="center">Centro</label>
                <select name="center_id" id="center_id" class="list-space">                    
                    <option value="">Nessun centro</option>
                    @foreach($centers as $center)
                        <option class="list-value" value="{{ $center->id }}" @selected(old('center_id')==$center->id)>
                        {{ $center->name }}, {{ $center->city }}
                        </option>
                    @endforeach                    
                </select>
            </div>


                <!-- categorie -->
                <div class="form-group">

                    <p class="text form-label">Categorie</p>

                    <div class="categories-box">
                        @foreach($categories as $category)
                        <label class="category-item">
                            <input type="checkbox"
                                name="categories[]"
                                value="{{ $category->id }}"
                                @checked(in_array($category->id, old('categories', [])))>
                            <span>{{ $category->name }}</span>
                        </label>
                        @endforeach
                    </div>
            </div>   
        </div>
    
        <!-- conferma creazione -->
        <div class="form-confirm">
            <button type="submit" class="button button-confirm">Crea utente</button>
        </div>
    </form>
</div>

<script src="{{ asset('JS/admin/new-user-tech.js') }}" defer></script>
@endsection