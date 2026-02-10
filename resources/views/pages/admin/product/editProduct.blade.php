@extends("layouts.mainLayout")


@section('content')

<!-- card nuovo prodotto -->
<div class="card user-space">

    <!-- sezione form -->
    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" class="create-product-form" enctype="multipart/form-data">
        @csrf   
        @method('PUT')
        
        <div class="user-grid">
            <!-- prendo elementi form -->
            @include('pages.admin.product.formProduct', ['product' => $product->id ? $product : null])
        </div>
        

        <!-- conferma creazione -->
        <div class="button-section">
            <div class="form-confirm">
                <button type="submit" class="button button-back">Annulla</button>
            </div>

            <div class="form-confirm">
                <button type="submit" class="button button-confirm">Salva modifiche</button>
            </div>
        </div>
    </form>
</div>
@endsection