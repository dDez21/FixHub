@extends("layouts.mainLayout")


@section('content')


<!-- torno indietro -->
<div class="new-element">
    <a class="add-product" href="{{ route('catalog' )}}">
            <img class="add-product-icon" src="{{ asset('icon/back.png') }}" alt="">
        </a>
</div>


<!-- card prodotto -->
<div class="card product-space">
    
    <!-- sezione dati prodotto -->
    <div class="product-section">
        <p class="text product-name">{{ $product->name }}</p>
        <p class="product-data">{{ $product->description }}</p>
        
        <p class="medium-text product-cat">Tecniche d'uso</p>
        <p class="product-data">{{ $product->use_techniques }}</p>
        
        <p class="medium-text product-cat">Guida all'installazione</p>
        <p class="product-data">{{ $product->installation }}</p>


        <!-- lista malfunzionamenti -->
        @can('isStaff' || 'isTech')
            
            <!-- decido la route in base al livello di autenticazione -->

            <!-- da sistemare, posso direttamente passare alla schermata il livello d'autenticazione (sempre che già non lo faccia) -->
            <!-- posso passare valori dalla route su web.php senza usare php se sono valori fattibili -->
            @php
                $routeName = auth()->user()->role === 'staff'
                    ? 'staff.products.malfunctions'
                    : 'tecn.products.malfunctions';
            @endphp

            <p class="medium-text product-cat">Malfunzionamenti</p>

            <!-- collegamento a lista malfunzionamenti del prodotto selezionato -->
            <a class="product-malf" href="{{ route($routeName, $product) }}">
                Vedi elenco malfunzionamenti →
            </a>
        @endcan
    </div>

    <!-- foto prodotto -->
    <div class="product-photo">
        <img src="{{ $product?->photo ? asset('storage/'.$product->photo) : asset('images/noPhoto.png') }}" alt="">
    </div>


    @can('isAdmin')
        <div class="product-action">

            <!-- modifica prodotto -->
            <div class="new-element">
                <a id="malf-edit-link" class="add-user" href="{{ route('admin.products.editProduct', ['product' => $product->id]) }}">
                    <img class="add-user-icon" src="{{ asset('icon/edit.png') }}" alt="">
                </a>
            </div>

            <!-- elimina prodotto -->
            <div class="new-element" id="delete-wrap">
                <a id="malf-delete-link" class="add-user" href="{{ route('admin.products.deleteConfirm', ['product' => $product->id]) }}">
                    <img class="add-user-icon" src="{{ asset('icon/remove.png') }}" alt="">
                </a>
            </div>
        </div>
    @endcan

</div>
@endsection