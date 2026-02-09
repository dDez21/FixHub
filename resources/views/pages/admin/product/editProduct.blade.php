@extends("layouts.mainLayout")


@section('content')

<!-- card nuovo prodotto -->
<div class="card user-space">

    <!-- sezione form -->
    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" class="create-product-form">
        @csrf   
        @method('PUT')
        
        <div class="user-grid">
            <!-- prendo elementi form -->
            @include('pages.admin.product.formProduct', ['product' => $product->id ? $product : null])
        </div>
        

        <!-- conferma creazione -->
        <div class="form-confirm">
            <button type="submit" class="button button-confirm">Modifica prodotto</button>
        </div>
    </form>
</div>
@endsection