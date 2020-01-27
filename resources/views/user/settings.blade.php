@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-300">
    <div class="w-6/12 px-12 py-12 shadow-lg bg-white">
        <form action="/user/settings" method="post">
            @method('PUT')
            @csrf
            <h1 class="text-gray-700 text-4xl font-light">Configuración</h1>
            <hr class="border-t-2 border-yellow-400 my-4" />

            <h2 class="font-bold mb-4">Localidades a permitir (una por línea)</h2>
            <textarea class="border border-gray-300 border-solid" name="allowed-locations" id="allowed-locations" cols="50" rows="5">{{ $user['allowed-locations'] ?? '' }}</textarea>

            <div class="block my-4">
                <input class="tracking-wide font-bold rounded bg-yellow-500 text-white shadow-md py-2 px-6 cursor-pointer" type="submit" value="Guardar">
            </div>
        </form>
    </div>
</div>
@endsection