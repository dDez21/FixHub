@extends("layouts.mainLayout")


@section('content')

<!-- se tecnico -->
@php $isTech = old('role') === 'tech'; @endphp

<!-- card nuovo utente -->
<div class="card user-space">

    <!-- sezione form -->
    <form method="POST" action="{{ route('admin.users.store') }}" class="create-user-form">
        @csrf   
        
        <div class="user-grid">
            <!-- prendo elementi form -->
        @include('pages.admin.user.formUser', ['user' => null])
        </div>
        

        
        <div class="button-section">
            <!-- annulla creazione -->
            <div class="form-confirm">
                <button type="button" class="button button-back" onclick="window.location='{{ route('admin.users.show') }}'">Annulla</button>
            </div>
            
            <!-- conferma creazione -->
            <div class="form-confirm">
                <button type="submit" class="button button-confirm">Crea utente</button>
            </div>
        </div>
    </form>
</div>

<script src="{{ asset('JS/admin/new-user-tech.js') }}" defer></script>
@endsection