@extends("layouts.mainLayout")


@section('content')

<!-- card nuovo centro -->
<div class="card user-space">

    <!-- sezione form -->
    <form method="POST" action="{{ route('admin.centers.store') }}" class="create-user-form">
        @csrf   
        
        <div class="user-grid">
            <!-- prendo elementi form -->
        @include('pages.admin.centers.formCenter', ['center' => null])
        </div>
        

        
        <div class="button-section">
            <!-- annulla creazione -->
            <div class="form-confirm">
                <button type="submit" class="button button-back">Annulla</button>
            </div>
            
            <!-- conferma creazione -->
            <div class="form-confirm">
                <button type="submit" class="button button-confirm">Crea utente</button>
            </div>
        </div>
    </form>
</div>

<script src="{{ asset('JS/admin/new-center.js') }}" defer></script>
@endsection