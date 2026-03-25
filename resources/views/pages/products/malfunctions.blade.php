@extends("layouts.mainLayout")

@section('content') 

<div class="new-element">
    <a class="add-product" href="{{ route('catalog' )}}">
            <img class="add-product-icon" src="{{ asset('icon/back.png') }}" alt="">
    </a>
</div>


<div class="malfunctions-layout">
    
    
    <!-- elenco centri -->
    <div class="malfunctions-list" data-search-url="{{ route($isStaff ? 'staff.products.malfunctions.search' : 'tecn.products.malfunctions.search', $product) }}">
        
        <h1 class="text">Lista malfunzionamenti @if(isset($product)) {{ $product->name }} @endif </h1>


        <!-- barra di ricerca -->
        <div class="search-bar">
            <input class="search-input" id="malf-input" type="text" placeholder="Ricerca un malfunzionamento">
            <button id="malf-button" type="button" class="search-btn">🔍</button>
        </div>


        <!-- card centri -->
        <div class="card malfunctions-card">
            

            <!-- nuovo malfunzionamento se staff -->
            @can('$isStaff')

                <div class="new-element">
                    <a class="add-user" href="{{ route('staff.products.malfunctions.create', ['product' => $product]) }}">
                        <img class="add-user-icon" src="{{ asset('icon/new.png') }}" alt="">
                    </a>
                </div>
            @endcan


            <!-- scroller verticale -->
            <div class="malfunctions" role="list" id="malfunctions">
                @forelse ($malfunctions as $m)
                    <div class="malfunction-single"
                        role="button"
                        tabindex="0"
                        data-id="{{ $m->id }}"
                        data-name="{{ $m->name }}"
                        data-description="{{ $m->description }}"
                        data-solution="{{ $m->solution }}"
                        @can('$isStaff')
                            data-edit-url="{{ route('staff.products.malfunctions.edit', ['product' => $product, 'malfunction' => $m]) }}"
                            data-delete-url="{{ route('staff.products.malfunctions.deleteConfirm', ['product' => $product, 'malfunction' => $m]) }}"
                        @endcan>
                            <p class="medium-text malfunction-item">{{ $m->name }}</p>
                    </div>
                @empty
                    <!-- nessun centro inserito -->
                    <div class="malfunction-item">Nessun malfunzionamento registrato.</div>
                @endforelse
            </div>

            <p class="no-results" id="no-results" style="display:none;">
                La ricerca non ha prodotto risultati
            </p>
        </div>
    </div>


    <!-- dettagli malf selezionato -->
    <div class="malfunction-data-container">
        <div class="card card-malfunction-data" id="malfunction-data" style="display:none;" aria-hidden="true"> <!-- la mostro solo quando ho un centro selezionato -->
            
            <h1 class="malfunction-item title" id="malfunction-name"></h1> <!-- nome -->
            
            <div class="malfunction-desc">
                <p class="malfunction-item medium-text" id="malfunction-description"></p> <!-- descrizione -->
            </div>

            <p class="malfunction-item medium-text" id="malfunction-solution"></p> <!-- soluzione -->
        


            @can('$isStaff')
                <div class="malfunction-action" id="malfunction-actions" style="display:none;">
                    <div class="new-element">
                        <a id="malf-edit-link" class="add-user" href="javascript:void(0)" aria-disabled="true">
                            <img class="add-user-icon" src="{{ asset('icon/edit.png') }}" alt="">
                        </a>
                    </div>

                    <div class="new-element" id="delete-wrap">
                        <a id="malf-delete-link" class="add-user" href="javascript:void(0)" aria-disabled="true">
                            <img class="add-user-icon" src="{{ asset('icon/remove.png') }}" alt="">
                        </a>
                    </div>
                </div>
            @endcan
        </div>
    </div>
    
</div>

<script src="{{ asset('JS/pages/malfunctions.js') }}" defer></script>
@endsection