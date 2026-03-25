@extends("layouts.mainLayout")

@php
    use Illuminate\Support\Facades\Gate;

    $searchRoute = Gate::allows('isStaff')
        ? route('staff.products.malfunctions.search', $product)
        : route('tecn.products.malfunctions.search', $product);
@endphp

@section('content') 

<div class="new-element">
    <a class="add-product" href="{{ route('catalog') }}">
        <img class="add-product-icon" src="{{ asset('icon/back.png') }}" alt="">
    </a>
</div>

<div class="malfunctions-layout">
    
    <div class="malfunctions-list" data-search-url="{{ $searchRoute }}">
        
        <h1 class="text">
            Lista malfunzionamenti @if(isset($product)) {{ $product->name }} @endif
        </h1>

        <div class="search-bar">
            <input class="search-input" id="malf-input" type="text" placeholder="Ricerca un malfunzionamento">
            <button id="malf-button" type="button" class="search-btn">src="{{ asset('icon/search.png') }}"</button>
        </div>

        <div class="card malfunctions-card">
            
            @can('isStaff')
                <div class="new-element">
                    <a class="add-user" href="{{ route('staff.products.malfunctions.create', ['product' => $product]) }}">
                        <img class="add-user-icon" src="{{ asset('icon/new.png') }}" alt="">
                    </a>
                </div>
            @endcan

            <div class="malfunctions" role="list" id="malfunctions">
                @forelse ($malfunctions as $m)
                    <div class="malfunction-single"
                        role="button"
                        tabindex="0"
                        data-id="{{ $m->id }}"
                        data-name="{{ $m->name }}"
                        data-description="{{ $m->description }}"
                        data-solution="{{ $m->solution }}"
                        @can('isStaff')
                            data-edit-url="{{ route('staff.products.malfunctions.edit', ['product' => $product, 'malfunction' => $m]) }}"
                            data-delete-url="{{ route('staff.products.malfunctions.deleteConfirm', ['product' => $product, 'malfunction' => $m]) }}"
                        @endcan
                    >
                        <p class="medium-text malfunction-item">{{ $m->name }}</p>
                    </div>
                @empty
                    <div class="malfunction-item">Nessun malfunzionamento registrato.</div>
                @endforelse
            </div>

            <p class="small-text-results" id="no-results" style="display:none;">
                La ricerca non ha prodotto risultati
            </p>
        </div>
    </div>

    <div class="malfunction-data-container">
        <div class="card card-malfunction-data" id="malfunction-data" style="display:none;" aria-hidden="true">
            
            <h1 class="malfunction-item title" id="malfunction-name"></h1>
            
            <div class="malfunction-desc">
                <p class="malfunction-item medium-text" id="malfunction-description"></p>
            </div>

            <p class="malfunction-item medium-text" id="malfunction-solution"></p>

            @can('isStaff')
                <div class="malfunction-action" id="malfunction-actions" style="display:none;">
                    <div class="new-element">
                        <a id="malf-edit-link" class="add-user" href="javascript:void(0)" aria-disabled="true">
                            <img class="add-user-icon" src="{{ asset('icon/edit.png') }}" alt="">
                        </a>
                    </div>

                    <div class="new-element" id="delete-wrap">
                        <a id="malf-delete-link" class="add-user" href="javascript:void(0)" aria-disabled="true">
                            <img class="add-user-icon" src="{{ asset('icon/remove.png') }}" alt="">
                        </a>
                    </div>
                </div>
            @endcan
        </div>
    </div>
    
</div>

<script src="{{ asset('JS/pages/malfunctions.js') }}" defer></script>
@endsection