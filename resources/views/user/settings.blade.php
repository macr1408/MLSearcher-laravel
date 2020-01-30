@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-300">
    <div class="w-6/12 px-12 py-6 shadow-lg bg-white">
        <form action="/user/settings" method="post">
            @method('PUT')
            @csrf
            <h1 class="text-gray-700 text-4xl font-light">Configuración</h1>
            <hr class="border-t-2 border-yellow-400 mb-10 mt-2" />

            <div class="mb-10 flex justify-center flex-wrap">
                <a class="mb-4 font-bold rounded bg-yellow-500 text-white py-2 px-6 cursor-pointer" href="{{ 'http://auth.mercadolibre.com.ar/authorization?response_type=code&client_id=' . env('ML_CLIENT_ID') . '&redirect_uri=' . route('settings_authorize')}}">{{ Carbon\Carbon::now() > $user['ml_token_expiry'] ? 'Conectar con Mercadolibre' : 'Conectado con Mercadolibre' }}</a>
                <p class="w-full italic text-sm text-gray-700">Al conectar tu cuenta con Mercadolibre podrás realizar búsquedas completas, de lo contrario tus búsquedas estarán limitadas hasta cierta cantidad de resultados.</p>
            </div>

            <div>
                <h2 class="font-bold mb-2 text-sm">Localidades a permitir (separadas por coma)</h2>
                <textarea placeholder="Belgrano, Rivadavia" class="border border-gray-300 border-solid px-2" name="allowed-locations" id="allowed-locations" cols="50" rows="5">{{ $user['allowed-locations'] ?? '' }}</textarea>
            </div>

            <div class="block my-4">
                <input class="font-bold rounded bg-yellow-500 text-white shadow-md py-2 px-6 cursor-pointer" type="submit" value="Guardar">
            </div>
        </form>
    </div>
</div>
@endsection