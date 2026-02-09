@extends("layouts.mainLayout")

@php use Illuminate\Support\Facades\Storage; @endphp <!-- collegamento a storage pubblico per immagine prodotto -->

@section('content')

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

        <!-- malfunzionamenti -->
        @if(auth()->check() && (auth()->user()->role === 'tech' || auth()->user()->role === 'staff'))
            @php
                $routeName = auth()->user()->role === 'staff'
                    ? 'staff.products.malfunctions'
                    : 'tecn.products.malfunctions';
            @endphp

            <a id="product-edit-link" class="add-user" href="{{ route($routeName, $product) }}">
                <p class="medium-text product-cat">Elenco malfunzionamenti -></p>
            </a>
        @endif

        <!-- modifica o rimuovi prodotto -->
        @if(auth()->check() && (auth()->user()->role === 'tech' || auth()->user()->role === 'staff'))
            @php
                $routeName = auth()->user()->role === 'staff'
                    ? 'staff.products.malfunctions'
                    : 'tecn.products.malfunctions';
            @endphp

            <p class="medium-text product-cat">Malfunzionamenti</p>

            <a class="product-data product-link-row" href="{{ route($routeName, $product) }}">
                Vedi elenco malfunzionamenti →
            </a>
        @endif
    </div>

    <!-- foto prodotto -->
    <div class="product-photo">
        <img src="{{ $product->photo ? Storage::url($product->photo) : asset('images/noPhoto.png') }}" alt="">
    </div>

</div>
@endsection