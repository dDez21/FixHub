@extends('layouts.mainLayout')

@section('content')

<div class="card user-space">
  <form method="POST" action="{{ route('admin.centers.update', $center) }}" class="create-user-form">
    @csrf
    @method('PUT')

    <div class="user-grid">

        <!-- prendo elementi form -->
        @include('pages.admin.center.formCenter', ['center' => $center])
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

<script src="{{ asset('JS/admin/new-center.js') }}" defer></script>
@endsection