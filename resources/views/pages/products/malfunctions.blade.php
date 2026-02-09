@extends("layouts.mainLayout")

@section('content') 

<div class="where-layout">
    
    <!-- elenco centri -->
    <div class="centers-list">
        
        <h1 class="text">Lista malfunzionamenti @if(isset($product)) {{ $product->name }} @endif </h1>

        <!-- card centri -->
        <div class="card">
            
            <!-- scroller verticale -->
            <div class="centers" role="list">
                
                
                @forelse ($malfunctions as $malfunction)
                    
                    <!-- prendo dati di ogni malfunction -->
                    <div class="center-single malfunction-single" role="button" tabindex="0"
                         data-name="{{ $malfunction->name }}"
                         data-description="{{ $malfunction->description }}"
                         data-solution="{{ $malfunction->solution }}"
                         >

                        <!-- dati mostrati nell'elenco centri -->
                        <p class="medium-text center-item">{{ $malfunction->name }}</p>
                    </div>

                @empty
                    <!-- nessun centro inserito -->
                    <div class="center-item">Nessun malfunzionamento registrato.</div>
                @endforelse
            </div>
        </div>
    </div>


    <!-- dettagli centro selezionato -->
    <div class="card card-center-data" id="malfunction-data"> <!-- la mostro solo quando ho un centro selezionato -->
        
        <h1 class="center-item title" id="malfunction-name"></h1> <!-- nome -->
        <p class="center-item medium-text" id="malfunction-description"></p> <!-- descrizione -->
        <p class="center-item medium-text" id="malfunction-solution"></p> <!-- soluzione -->
    </div> 
    
    
</div>

<script src="{{ asset('JS/pages/malfunction.js') }}" defer></script>
@endsection