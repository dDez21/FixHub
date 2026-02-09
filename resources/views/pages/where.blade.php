@extends("layouts.mainLayout")

@section('content') 

<div class="where-layout">
    
    <!-- elenco centri -->
    <div class="centers-list">
        
        <div class="centers-header">
            <h1 class="text">I nostri centri</h1>

            @if ($isAdmin)
                <a class="add-user" href="{{ route('admin.centers.create') }}">
                    <img class="add-user-icon" src="{{ asset('icon/add.png') }}" alt="">
                </a>
        </div>

        <!-- card centri -->
        <div class="card">
            
            <!-- scroller verticale -->
            <div class="centers" role="list">
                
                
                @forelse ($centers as $center)
                    
                    <!-- prendo dati di ogni centro-->
                    <div class="center-single" role="button" tabindex="0"
                         data-name="{{ $center->name }}"
                         data-address="{{ $center->street }}"
                         data-civic="{{ $center->civic }}"
                         data-city="{{ $center->city_id }}"
                         data-phone="{{ $center->phone }}"
                         data-email="{{ $center->email }}"
                         data-provincia="{{ $center->province_id }}"
                         data-region="{{ $center->region_id }}">

                        <!-- dati mostrati nell'elenco centri -->
                        <p class="medium-text center-item">{{ $center->name }}</p>
                        <p class="small-text center-item">{{ $center->street }} {{ $center->civic }}@if($center->city_id), {{ $center->city_id }}@endif</p>
                    </div>

                @empty
                    <!-- nessun centro inserito -->
                    <div class="center-item">Nessun centro disponibile.</div>
                @endforelse
            </div>
        </div>
    </div>


    <!-- dettagli centro selezionato -->
    <div class="card card-center-data" id="center-data"> <!-- la mostro solo quando ho un centro selezionato -->
        
        <h1 class="center-item title" id="center-name"></h1> <!-- nome centro -->
        <p class="center-item medium-text" id="center-address"></p> <!-- indirizzo centro -->
        <p class="center-item medium-text" id="center-phone"></p> <!-- telefono centro -->
        <p class="center-item medium-text" id="center-email"></p> <!-- email centro -->
    </div> 
    
    
</div>

<script src="{{ asset('JS/pages/center-data-where.js') }}" defer></script>
@endsection