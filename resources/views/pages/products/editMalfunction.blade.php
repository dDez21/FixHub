@extends('layouts.mainLayout')

@section('content')

<div class="card malfunction-space">
  <form method="POST" action="{{ route('staff.malfunction.update', $malfunction) }}" class="create-malfunction-form">
    @csrf
    @method('PUT')

    <div class="malfunction-grid">
        <!-- prendo elementi form -->
        @include('pages.staff.malfunction.formMalfunction', ['malfunction' => $malfunction])
    </div>

    <!-- bottoni azioni -->
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