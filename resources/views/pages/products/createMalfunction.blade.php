@extends("layouts.mainLayout")


@section('content')

<!-- card nuovo malf -->
<div class="card malfunction-space">

    <!-- sezione form -->
    <form method="POST" action="{{ route('staff.malfunctions.store') }}" class="create-malfunction-form">
        @csrf   
        
        <div class="malfunction-grid">
            <!-- prendo elementi form -->
        @include('pages.products.formMalfunction', ['malfunction' => null])
        </div>
        

        
        <!-- conferma creazione -->
        <div class="form-confirm">
            <button type="submit" class="button button-confirm">Crea malfunzionamento</button>
        </div>
    </form>
</div>

@endsection