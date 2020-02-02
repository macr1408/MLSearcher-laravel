@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-300">
    <div class="bg-yellow-200 w-11/12 mt-2 md:w-6/12 px-5 md:px-12 py-12 shadow-lg">
        <div class="text-3xl mb-10 text-center block font-bold">{{ __('LOGIN') }}</div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="flex justify-center flex-wrap">
                <div class="w-full md:w-8/12 mb-10">
                    <input class="@error('email') text-red-600 @enderror border-2 border-white border-solid w-full p-2 rounded-sm" placeholder="Email" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="w-full md:w-8/12">
                    <input class="@error('password') text-red-600 @enderror border-2 border-white border-solid w-full p-2 rounded-sm" placeholder="Password" id="password" type="password" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mt-4 block w-full text-center">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>


            <div class="flex flex-wrap justify-center my-4">
                <button type="submit" class="w-11/12 md:w-5/12 bg-yellow-600 py-2 px-4 text-white shadow rounded-sm">
                    {{ __('Login') }}
                </button>
            </div>
            <div class="flex justify-center">
                @if (Route::has('password.request'))
                <a class="text-sm" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection