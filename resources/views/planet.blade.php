<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($responseBody->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <p>Período de rotação: {{$responseBody->rotation_period}} dias</p>
                <p>Período de órbita: {{$responseBody->orbital_period}} dias</p>
                <p>Diâmetro: {{$responseBody->diameter}} quilômetros</p>
                <p>Clima: {{$responseBody->climate}}</p>
                <p>Terreno: {{$responseBody->terrain}}</p>
                <p>Superfície de água: {{$responseBody->surface_water}}</p>
                <p>População: {{$responseBody->population}}</p>
                <h3>Notáveis:</h3>
                @foreach($notables as $notable)
                    <p>{{$notable}}</p>
                @endforeach
                <h3>Filmes:</h3>
                @foreach($movies as $movie)
                    <p>{{$movie}}</p>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
