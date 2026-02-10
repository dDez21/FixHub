@extends("layouts.mainLayout")


@section('content')

<!-- card nuovo prodotto -->
<div class="card user-space">

    <!-- sezione form -->
    <form method="POST" action="{{ route('admin.products.store') }}" class="create-product-form" enctype="multipart/form-data">
        @csrf   
        
        <div class="user-grid">
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