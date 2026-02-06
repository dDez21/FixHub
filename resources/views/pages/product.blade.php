@extends("layouts.mainLayout")

@php use Illuminate\Support\Facades\Storage; @endphp <!-- collegamento a storage pubblico per immagine prodotto -->

@section('content')

<!-- card prodotto -->
<div class="card product-card">
    
    <!-- foto prodotto -->
    <div class="product-photo">
        <img src="{{ $product->photo ? Storage::url($product->photo) : asset('images/noPhoto.png') }}" alt="">
    </div>
    
    
    <!-- sezione dati prodotto -->
    <div class="product-section">
        <p class="text product-name">{{ $product->name }}</p>
        <p class="product-description">{{ $product->description }}</p>
        
        <p class="text product-use-techniques">Tecniche d'uso</p>
        <p class="product-use_techniques-data">{{ $product->use_techniques }}</p>
        
        <p class="text product-installation">Guida all'installazione</p>
        <p class="product-installation-data">{{ $product->installation }}</p>
    </div>

    

</div>
@endsection