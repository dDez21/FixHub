@extends("layouts.mainLayout")

@section('content') 

<div class="where-layout">
    
    <!-- elenco centri -->
    <div class="centers-list">
        
        <div class="centers-header">
            <h1 class="text">I nostri centri</h1>

            @if ($isAdmin)
                <a class="add-product" href="{{ route('admin.centers.create') }}">
                    <img class="add-user-icon" src="{{ asset('icon/new.png') }}" alt="">
                </a>
            @endif
        </div>

        <!-- card centri -->
        <div class="card">
            
            <!-- scroller verticale -->
            <div class="centers" role="list">
                
                
                @forelse ($centers as $center)
                    
                    <!-- prendo dati di ogni centro-->
                    <div class="center-single" role="button" tabindex="0"
                         data-id="{{ $center->id }}" 
                         data-name="{{ $center->name }}"
                         data-address="{{ $center->street }}"
                         data-civic="{{ $center->civic }}"
                         data-city="{{ $center->city_id }}"
                         data-phone="{{ $center->phone }}"
                         data-email="{{ $center->email }}"
                         data-provincia="{{ $center->province_id }}"
                         data-region="{{ $center->region_id }}">

                        <!-- dati mostrati nell'elenco centri -->
                        <p class="medium-text center-item">{{ $center->name }}</p>
                        <p class="small-text center-item">{{ $center->street }} {{ $center->civic }}@if($center->city_id), {{ $center->city_id }}@endif</p>
                    </div>

                @empty
                    <!-- nessun centro inserito -->
                    <div class="center-item">Nessun centro disponibile.</div>
                @endforelse
            </div>
        </div>
    </div>


    <!-- dettagli centro selezionato -->
    <div class="centers-detail-area">
        @forelse ($centers as $center)
            <div class="card card-center-data center-detail"
                id="center-data-{{ $center->id }}"
                style="display:none;">

                <h1 class="center-item title" id="center-name-{{ $center->id }}">{{ $center->name }}</h1>
                <p class="center-item medium-text">
                    {{ $center->street }} {{ $center->civic }}
                    @if($center->city_id), {{ $center->city_id }} @endif
                </p>
                <p class="center-item medium-text">Telefono: +39 {{ $center->phone }}</p>
                <p class="center-item medium-text">Email: {{ $center->email }}</p>

                @if ($isAdmin)
                    <div class="user-action">
                        <div class="new-element">
                            <a class="add-user"
                            href="{{ route('admin.centers.edit', ['center' => $center->id]) }}">
                                <img class="add-user-icon" src="{{ asset('icon/edit.png') }}" alt="">
                            </a>
                        </div>

                        <div class="new-element">
                            <a class="add-user"
                            href="{{ route('admin.centers.deleteConfirm', ['center' => $center->id]) }}">
                                <img class="add-user-icon" src="{{ asset('icon/remove.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <div class="card card-center-data">
                <p>Nessun centro disponibile.</p>
            </div>
        @endforelse
    </div>
    
    
</div>

<script src="{{ asset('JS/pages/center-data-where.js') }}" defer></script>
@endsection