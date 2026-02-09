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


        <!-- modifica o rimuovi prodotto -->
        @if(auth()->check() && (auth()->user()->role === 'tech' || auth()->user()->role === 'staff'))
            @php
                $routeName = auth()->user()->role === 'staff'
                    ? 'staff.products.malfunctions'
                    : 'tecn.products.malfunctions';
            @endphp

            <p class="medium-text product-cat">Malfunzionamenti</p>

            <a class="product-malf" href="{{ route($routeName, $product) }}">
                Vedi elenco malfunzionamenti →
            </a>
        @endif
    </div>

    <!-- foto prodotto -->
    <div class="product-photo">
        <img src="{{ $product->photo ? Storage::url($product->photo) : asset('images/noPhoto.png') }}" alt="">
    </div>


    <div class="product-action">
        <div class="new-element">
            <a id="malf-edit-link" class="add-user" href="#">
                <img class="add-user-icon" src="{{ asset('icon/edit.png') }}" alt="">
            </a>
        </div>

        <div class="new-element" id="delete-wrap">
            <a id="malf-delete-link" class="add-user" href="#">
                <img class="add-user-icon" src="{{ asset('icon/remove.png') }}" alt="">
            </a>
        </div>
    </div>

</div>
@endsection