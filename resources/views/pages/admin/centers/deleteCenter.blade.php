@extends("layouts.mainLayout")


@section('content')



<div class="delete-user-layout">

    <div class="delete-user-card card">
        <h1 class="title deleteText">Sei sicuro di voler eliminare il centro {{ $center->name }}?</h1>
        
            <form action="{{ route('admin.centers.delete', $center) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="button">Elimina</button>
            </form>
    </div>
@endsection