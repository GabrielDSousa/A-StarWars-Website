<?php
function randomStarship(){
    $starship = 'rocket-'.rand("1","29");
    return @svg($starship, ['class' => 'object-contain h-12 w-12', 'fill' => 'white']);
}

function randomPlanet(){
    $planet = 'planet'.rand("1","21");
    return @svg($planet, ['class' => 'object-contain h-16 w-16']);
}
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-white bg-transparent">
            {{ __('Favoritos') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-4">
        {{--Here is my own code--}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($favorites as $favorite)
                <div>
                    <a href="/details/{{explode("http://swapi.dev/api/", $favorite->url)[1]}}">
                        <?php
                        $id = $favorite->id;
                        ?>
                        <div class="p-6 max-w-sm mx-auto bg-gray-900 rounded-xl shadow-md flex items-center space-x-4 hover:bg-gray-700 relative">
                            <x-form-button :action="route('delete', $id)" method="DELETE" class="absolute top-0 right-0 p-4">
                                <x-fas-trash class="p-2 flex items-center justify-center text-xs text-red-600 hover:bg-red-900"/>
                            </x-form-button>
                            <div class="flex-shrink-0">
                                @if(str_contains($favorite->url, 'planets'))
                                    {{randomPlanet()}}
                                @endif
                                @if(str_contains($favorite->url, 'starships'))
                                    {{randomStarship()}}
                                @endif
                            </div>
                            <div>
                                <div class="text-xl font-medium text-white">{{ $favorite->name }}</div>
                                <p class="text-gray-400">Ver mais</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    {{--Here is my own code--}}
</x-app-layout>


