@extends("layouts.mainLayout")

@section('content')

<div class="users-layout">

    <div class="users-list">
        <div class="card users-card">

            <div class="new-element">
                <a class="add-user" href="{{ route('admin.users.createUser') }}">
                    <img class="add-user-icon" src="{{ asset('icon/new.png') }}" alt="">
                </a>
            </div>

            <div class="users" role="list">
                @forelse ($users as $u)
                    <div class="user-single" role="button" tabindex="0"
                        data-id="{{ $u->id }}"
                        data-name="{{ $u->name }}"
                        data-surname="{{ $u->surname }}"
                        data-role="{{ $u->role }}"
                        data-username="{{ $u->username }}"
                        data-tech-url="{{ route('admin.users.tech', $u) }}"
                        data-staff-url="{{ route('admin.users.staff', $u) }}"
                        data-edit-url="{{ route('admin.users.editUser', $u) }}"
                        data-delete-url="{{ route('admin.users.deleteConfirm', $u) }}"
                                            >
                        <p class="medium-text user-item">{{ $u->name }} {{ $u->surname }}</p>

                        <p class="small-text user-item">
                            @if($u->role == 'admin')Admin
                            @elseif($u->role == 'tech')Tecnico
                            @elseif($u->role == 'staff')Staff
                            @endif
                        </p>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>


    <!-- contenitore dati utente -->
    <div class="user-data-container">
        <div class="card card-user-data" id="user-data">

            <div class="user-item-name">
                <h1 class="user-item title" id="user-name"></h1>
                <h1 class="user-item title" id="user-surname"></h1>
            </div>

            <p class="user-item medium-text" id="user-role"></p>
            <p class="user-item medium-text" id="user-username"></p>

            <!-- tecj -->
            <div id="tech-data" style="display: none;">
                <p class="user-item medium-text" id="user-tech-center"></p>
                <p class="user-item medium-text" id="user-tech-categories"></p>
            </div>

            <!-- staff -->
            <div id="staff-data" style="display: none;">
                <p class="user-item medium-text" id="user-staff-categories"></p>
            </div>

            <div class="user-action">
                <div class="new-element">
                    <a id="user-edit-link" class="add-user" href="#">
                        <img class="add-user-icon" src="{{ asset('icon/edit.png') }}" alt="">
                    </a>
                </div>

                <div class="new-element" id="delete-wrap">
                    <a id="user-delete-link" class="add-user" href="#">
                        <img class="add-user-icon" src="{{ asset('icon/remove.png') }}" alt="">
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>

<script src="{{ asset('JS/pages/users-data.js') }}" defer></script>
@endsection