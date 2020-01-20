@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-300">
    <div class="bg-yellow-200 w-6/12 px-20 py-12 shadow-lg">
        <div class="text-xl mb-10 text-center block font-bold">{{ __('Registrarme') }}</div>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="flex justify-between flex-wrap">
                <div class="w-full mb-6">
                    <input class="@error('email') text-red-600 @enderror border-2 border-white border-solid w-full p-2 rounded-sm" placeholder="Email" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="w-5/12">
                    <input class="@error('password') text-red-600 @enderror border-2 border-white border-solid w-full p-2 rounded-sm" placeholder="Password" id="password" type="password" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="w-5/12">
                    <input placeholder="Confirm password" id="password-confirm" type="password" class="border-2 border-white border-solid w-full p-2 rounded-sm" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="flex flex-wrap justify-center mt-10 mb-4">
                <button type="submit" class="w-5/12 bg-yellow-600 py-2 px-4 text-white shadow rounded-sm">
                    {{ __('Registrarme') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection