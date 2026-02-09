@extends("layouts.mainLayout")

@section('content') 

<div class="malfunctions-layout">
    
    <!-- elenco centri -->
    <div class="malfunctions-list">
        
        <h1 class="text">Lista malfunzionamenti @if(isset($product)) {{ $product->name }} @endif </h1>

        <!-- card centri -->
        <div class="card malfunctions-card">
            

            <!-- nuovo malfunzionamento se staff -->
            @if ($isStaff)

                <div class="new-element">
                    <a class="add-user" href="{{ route('staff.products.malfunctions.create', ['product' => $product]) }}">
                        <img class="add-user-icon" src="{{ asset('icon/new.png') }}" alt="">
                    </a>
                </div>
            @endif


            <!-- scroller verticale -->
            <div class="malfunctions" role="list">
                @forelse ($malfunctions as $m)
                    
                    <!-- prendo dati di ogni malfunction -->
                    <div class="malfunction-single" role="button" tabindex="0"
                         data-name="{{ $m->name }}"
                         data-description="{{ $m->description }}"
                         data-solution="{{ $m->solution }}"
                         >

                        <!-- dati mostrati nell'elenco centri -->
                        <p class="medium-text malfunction-item">{{ $m->name }}</p>
                    </div>

                @empty
                    <!-- nessun centro inserito -->
                    <div class="malfunction-item">Nessun malfunzionamento registrato.</div>
                @endforelse
            </div>
        </div>
    </div>


    <!-- dettagli centro selezionato -->
    <div class="malfunction-data-container">
        <div class="card card-malfunction-data" id="malfunction-data"> <!-- la mostro solo quando ho un centro selezionato -->
            
            <h1 class="malfunction-item title" id="malfunction-name"></h1> <!-- nome -->
            
            <div class="malfunction-desc">
                <p class="malfunction-item medium-text" id="malfunction-description"></p> <!-- descrizione -->
            </div>

            <p class="malfunction-item medium-text" id="malfunction-solution"></p> <!-- soluzione -->
        </div>

        
        <div class="malfunction-action">
            <div class="new-element">
                    <a id="user-edit-link" class="add-user" href="#">
                        <img class="add-user-icon" src="{{ asset('icon/edit.png') }}" alt="">
                    </a>
                </div>

                <div class="new-element" id="delete-wrap">
                    <a id="user-delete-link" class="add-user" href="#">
                        <img class="add-user-icon" src="{{ asset('icon/remove.png') }}" alt="">
                    </a>
                </div>
        </div>
    </div>
    
</div>

<script src="{{ asset('JS/pages/malfunctions.js') }}" defer></script>
@endsection