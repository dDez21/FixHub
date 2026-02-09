@extends("layouts.mainLayout")

@section('content') 

<!-- contenitore generale -->
<div class="product-create-layout">






</div>



@extends("layouts.mainLayout")


@section('content')

<!-- card nuovo utente -->
<div class="card product-space">

    <!-- sezione form -->
    <form method="POST" action="{{ route('admin.products.store') }}" class="create-product-form">
        @csrf   
        
        <div class="product-grid">
            <!-- prendo elementi form -->
        @include('pages.admin.product.formProduct', ['product' => null])
        </div>
        

        <!-- conferma creazione -->
        <div class="form-confirm">
            <button type="submit" class="button button-confirm">Crea prodotto</button>
        </div>
    </form>
</div>
@endsection