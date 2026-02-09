@extends("layouts.mainLayout")

@php use Illuminate\Support\Facades\Storage; @endphp <!-- collegamento a storage pubblico per immagine prodotto -->

@section('content') 

<!-- contenitore generale -->
<div class="catalog-layout">

    <!-- contenitore categorie-->
    <div class="categories-layout">

        <h1 class="title categories-title">Elenco categorie</h1>

        <!-- elenco categorie -->
        <div class="categories-list">

            <!-- mostro tutti i prodotti -->
            @if(!auth()->check() || auth()->user()->role !== 'staff')
                <li>
                    <a class="single-category" href="#" data-category-id="">Tutte le categorie</a>
                </li>
            @endif
            
            <!-- riferimenti per singola categoria -->
            @forelse ($categories as $category)
                <li>
                    <a class="single-category" href="#" data-category-id="{{ $category->id }}">{{ $category->name }}</a>
                </li>
            
            @empty
            @endforelse
        </div>
    </div>


    <!-- contenitore prodotti -->
    <div class="products-layout">

        @if ($isAdmin)

            <!-- aggiungo prodotto  -->
            <div class="new-element">
                <a class="add-product" href="{{ route('admin.products.createProduct') }}">
                    <img class="add-product-icon" src="{{ asset('icon/new.png') }}" alt="">
                </a>
            </div>
        @endif
        

        <!-- barra di ricerca -->
        <div class="search-bar">
            <input class="search-input" id="search-input" type="text" placeholder="Ricerca un prodotto">
            <!-- aggiungi bottone ricerca -->
        </div>


        <!-- categoria selezionata -->
        <p class="category-selected">
            <span id="selected-category-label">Tutte le categorie</span>
        </p>
            
            <!-- griglia prodotti -->
            <div class="products-grid">
                
                <!-- mostro elenco prodotti -->
                @forelse ($products as $product)

                    <!-- creo card singolo prodotto -->
                    <div class="card product-card"
                        data-name="{{ $product->name }}"
                        data-photo="{{ $product->photo }}"
                        data-description="{{ $product->description }}"                    
                        data-category-id="{{ $product->category_id }}">
                        
                        <!-- foto prodotto -->
                        <div class="product-icon">
                            <img src="{{ $product->photo ? Storage::url($product->photo) : asset('images/noPhoto.png') }}" alt="">
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

            <p class="no-results" id="no-results" style="display:none;">La ricerca non ha prodotto risultati</p>
    </div>
</div>
@endsection