@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-300">
    <div class="w-6/12 px-12 py-6 shadow-lg bg-white">
        <form action="/user/settings" method="post">
            @method('PUT')
            @csrf
            <h1 class="text-gray-700 text-4xl font-light">Configuración</h1>
            <hr class="border-t-2 border-yellow-400 mb-10 mt-2" />

            <div class="flex">
                <div class="mb-6 w-5/12 mr-4">
                    <h2 class="font-bold mb-2 text-sm">Client ID (Opcional)</h2>
                    <input type="text" name="ml-client-id" id="ml-client-id" value="{{ $user['ml_client_id'] ?? '' }}" placeholder="Mercadolibre Client ID" class="border border-gray-300 border-solid w-full px-2 py-1">
                </div>

                <div class="mb-6 w-5/12">
                    <h2 class="font-bold mb-2 text-sm">Client Secret (Opcional)</h2>
                    <input type="text" name="ml-client-secret" id="ml-client-secret" value="{{ $user['ml_client_secret'] ?? '' }}" placeholder="Mercadolibre Client Secret" class="border border-gray-300 border-solid w-full px-2 py-1">
                </div>
            </div>

            <div>
                <h2 class="font-bold mb-2 text-sm">Localidades a permitir (separadas por coma)</h2>
                <textarea placeholder="Belgrano, Rivadavia" class="border border-gray-300 border-solid" name="allowed-locations" id="allowed-locations" cols="50" rows="5">{{ $user['allowed-locations'] ?? '' }}</textarea>
            </div>

            <div class="block my-4">
                <input class="tracking-wide font-bold rounded bg-yellow-500 text-white shadow-md py-2 px-6 cursor-pointer" type="submit" value="Guardar">
            </div>
        </form>
    </div>
</div>
@endsection