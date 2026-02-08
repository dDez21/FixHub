@extends("layouts.mainLayout")


@section('content')



<div class="delete-user-layout">

    <div class="delete-user-card card">
        <h1 class="text deleteText">Sei sicuro di voler eliminare l'utente {{ $user->name }} {{ $user->surname }}?</h1>
        
        <div class="buttons">
            <form action="{{ route('admin.users.delete', $user) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="button">Elimina</button>
            </form>
            <a href="{{ route('admin.users') }}" class="button">Annulla</a>
        </div>
    </div>
@endsection