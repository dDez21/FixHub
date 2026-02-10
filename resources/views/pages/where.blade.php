@extends("layouts.mainLayout")

@section('content') 

<div class="where-layout">
    
    <!-- elenco centri -->
    <div class="centers-list">
        
        <div class="centers-header">
            <h1 class="text">I nostri centri</h1>

            @if ($isAdmin)
                <a class="add-product" href="{{ route('admin.centers.create') }}">
                    <img class="add-user-icon" src="{{ asset('icon/new.png') }}" alt="">
                </a>
            @endif
        </div>

        <!-- card centri -->
        <div class="card">
            
            <!-- scroller verticale -->
            <div class="centers" role="list">
                
                
                @forelse ($centers as $center)
                    
                    <!-- prendo dati di ogni centro-->
                    <div class="center-single" role="button" tabindex="0"
                         data-id="{{ $center->id }}" 
                         data-name="{{ $center->name }}"
                         data-address="{{ $center->street }}"
                         data-civic="{{ $center->civic }}"
                         data-city="{{ $center->city?->name }}"
                         data-phone="{{ $center->phone }}"
                         data-email="{{ $center->email }}"
                         data-provincia="{{ $center->province?->name }}"
                         data-region="{{ $center->region?->name }}"
                         data-edit-url="{{ route('admin.centers.edit', ['center' => $center->id]) }}"
                         data-delete-url="{{ route('admin.centers.deleteConfirm', ['center' => $center->id]) }}"
                        >

                        <!-- dati mostrati nell'elenco centri -->
                        <p class="medium-text center-item">{{ $center->name }}</p>
                        <p class="small-text center-item">{{ $center->street }} {{ $center->civic }}@if($center->city?->name), {{ $center->city?->name }}@endif</p>
                    </div>

                @empty
                    <!-- nessun centro inserito -->
                    <div class="center-item">Nessun centro disponibile.</div>
                @endforelse
            </div>
        </div>
    </div>


    <!-- dettagli centro selezionato -->
    <div class="card card-center-data" id="center-data">
        
        <h1 class="center-item title" id="center-name"></h1> <!-- nome centro -->
        <p class="center-item medium-text" id="center-address"></p> <!-- indirizzo centro -->
        <p class="center-item medium-text" id="center-phone"></p> <!-- telefono centro -->
        <p class="center-item medium-text" id="center-email"></p> <!-- email centro -->

        @if ($isAdmin)
                <div class="user-action">
                    <div class="new-element">
                        <a id="center-edit-link" class="add-user" href="#">
                            <img class="add-user-icon" src="{{ asset('icon/edit.png') }}" alt="">
                        </a>
                    </div>

                    <div class="new-element">
                        <a id="center-delete-link" class="add-user" href="#">
                            <img class="add-user-icon" src="{{ asset('icon/remove.png') }}" alt="">
                        </a>
                    </div>
                </div>
        @endif
    </div> 
    
    
</div>

<script src="{{ asset('JS/pages/center-data-where.js') }}" defer></script>
@endsection