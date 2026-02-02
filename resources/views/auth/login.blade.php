@extends('layouts.guest')

@section('content') 

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Username  -->
            <div class="login-form">
                <x-ui.input-label for="username" :value="__('Username')" />
                <x-ui.text-input id="username" type="text" name="username" :value="old('username')" required autofocus />
                <x-ui.input-error :messages="$errors->get('username')" class="mt-2" />
            </div>


            <!-- Password -->
            <div class="login-form">
                <x-ui.input-label for="password" :value="__('Password')" />
                <x-ui.text-input id="password"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <x-ui.input-error :messages="$errors->get('password')" class="mt-2" />
            </div>


            <!-- Remember Me -->
            <div class="remember-me">
                <label for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span class="small-text">{{ __('Remember me') }}</span>
                </label>
            </div>


            <div class="button-login">                
                <x-ui.primary-button class="ms-3">
                    {{ __('Log in') }}
                </x-ui.primary-button>
            </div>
        </form>
@endsection