@extends("layouts.mainLayout")

@php use Illuminate\Support\Facades\Storage; @endphp <!-- collegamento a storage pubblico per immagine prodotto -->

@section('content') 

<!-- contenitore generale -->
<div class="catalog-layout">

    <!-- contenitore categorie-->
    <div class="categories-layout">

        <h1 class="title categories-title">Elenco categorie</h1>

        <!-- elenco categorie -->
        <ul class="categories-list">

            <!-- mostro tutti i prodotti -->
            @if(!auth()->check() || auth()->user()->role !== 'staff')
            <li>
                <a class="single-category" href="#" data-category-id="all">Tutte le categorie</a>
            </li>
            @endif
            
            <!-- elenco categorie -->
            @foreach ($categories as $category)
                <li>
                    <a class="single-category" href="#" data-category-id="{{ $category->id }}">{{ $category->name }}</a>
                </li>
            
            @endforeach
            </ul>
    </div>


    <!-- contenitore prodotti -->
    <div class="products-layout" data-search-url="{{ route('catalog.search') }}">

        @can ('isAdmin')
            <!-- aggiungo prodotto  -->
            <div class="new-element">
                <a class="add-product" href="{{ route('admin.products.createProduct') }}">
                    <img class="add-product-icon" src="{{ asset('icon/new.png') }}" alt="">
                </a>
            </div>
        @endcan
        

        <!-- barra di ricerca -->
        <div class="search-bar">
            <input class="search-input" id="search-input" type="text" placeholder="Ricerca un prodotto">
            <button id="search-button" type="button" class="search-btn">🔍</button>
        </div>


        <!-- categoria selezionata -->
        <p class="category-selected">
            <span id="selected-category-label">Tutte le categorie</span>
        </p>
            
            <!-- griglia prodotti -->
            <div class="products-grid" id="products-grid">
                
                <!-- mostro elenco prodotti -->
                @forelse ($products as $product)

                    <!-- creo card singolo prodotto -->
                    <div class="card product-card">
                        
                        <!-- foto prodotto -->
                        <div class="product-icon">
                            <img src="{{ asset('storage/images/' . $product->photo) }}" alt="{{ $product->photo }}">
                        </div>
                        
                        <!-- nome prodotto -->
                        <div class="product-info">                    

                                <!-- gli do link a sua scheda -->
                                <a class="product-name-ref" href="{{ route('product', $product) }}">{{ $product->name }}</a>                    
                        </div>
                    </div>
                @empty

                    <!-- nessun prodotto salvato -->
                    <p class="text">Nessun prodotto presente</p>
                @endforelse
            </div>

            <p class="no-results" id="no-results" style="display:none;">
                La ricerca non ha prodotto risultati
            </p>
    </div>
</div>
@endsection