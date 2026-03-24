@extends("layouts.mainLayout")


@section('content')



<div class="delete-user-layout">

    <div class="delete-user-card card">
        <h1 class="title deleteText">Sei sicuro di voler eliminare il malfunzionamento?</h1>
        
            <form  action="{{ route('staff.products.malfunctions.delete', [$product, $malf]) }}"  method="POST">
                @csrf
                @method('DELETE')
                
                <div class="button-section">
                    <button type="button" class="button button-back" onclick="history.back()">Annulla</button>
                    <button type="submit" class="button">Elimina</button>
                </div>
            </form>
    </div>
@endsection