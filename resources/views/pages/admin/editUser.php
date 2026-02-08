@extends('layouts.mainLayout')

@section('content')

<div class="card user-space">
  <form method="POST" action="{{ route('admin.users.update', $user) }}" class="create-user-form">
    @csrf
    @method('PUT')

    <div class="user-grid">

        <!-- prendo elementi form -->
        @include('pages.admin.form', ['user' => $user])
    </div>

    <div class="form-confirm">
      <button type="submit" class="button button-confirm">Salva modifiche</button>
    </div>
  </form>
</div>
@endsection