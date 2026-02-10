@extends('layouts.mainLayout')

@section('content')

<div class="card malfunction-space">
  <form method="POST" action="{{ route('staff.products.malfunctions.update', ['product' => $product->id, 'malfunction' => $malf->id]) }}"  class="create-malfunction-form">
    @csrf
    @method('PUT')

    <div class="malfunction-grid">
        <!-- prendo elementi form -->
        @include('pages.products.formMalfunction', ['malfunction' => $malf])
    </div>

    <!-- bottoni azioni -->
    <div class="button-section">
      <div class="form-confirm">
        <button type="submit" class="button button-back" onclick="history.back()">Annulla</button>
      </div>

      <div class="form-confirm">
        <button type="submit" class="button button-confirm">Salva modifiche</button>
      </div>
    </div>
  </form>
</div>
@endsection