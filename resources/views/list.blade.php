<?php
function randomPlanet()
{
    $planet = 'planet' . rand("1", "21");
    return @svg($planet, ['class' => 'object-contain h-16 w-16']);
}

function randomStarship()
{
    $starship = 'rocket-' . rand("1", "29");
    return @svg($starship, ['class' => 'object-contain h-12 w-12', 'fill' => 'white']);
}

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-white bg-transparent">
            {{ __($name) }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-4">
        {{--Here is my own code--}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($responseBody->results as $response)
                <div>
                    <a href="/details/{{explode("http://swapi.dev/api/", $response->url)[1]}}">
                        <div
                            class="p-6 max-w-sm mx-auto bg-gray-900 rounded-xl shadow-md flex items-center space-x-4 hover:bg-gray-700">
                            <div class="flex-shrink-0">
                                @if(str_contains($response->url, 'planets'))
                                    {{randomPlanet()}}
                                @endif
                                @if(str_contains($response->url, 'starships'))
                                    {{randomStarship()}}
                                @endif
                            </div>
                            <div>
                                <div class="text-xl font-medium text-white">{{ $response->name }}</div>
                                <p class="text-gray-400">Ver mais</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

            <div @if(is_null($previous)) class="invisible" @endif>
                <a href="{{ route('list', ['type' => $type, 'page' => $previous])}}">
                    <div
                        class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center justify-center space-x-4 text-base font-medium text-white bg-blue-700 hover:bg-blue-900">
                        <div class="flex-shrink-0">
                            Anterior
                        </div>
                    </div>
                </a>
            </div>

            <div @if(is_null($next)) class="invisible" @endif>
                <a href="{{ route('list', ['type' => $type, 'page' => $next])}}">
                    <div
                        class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center justify-center  space-x-4 text-base font-medium text-white bg-blue-700 hover:bg-blue-900">
                        <div class="flex-shrink-0">
                            Próximo
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    {{--Here is my own code--}}
</x-app-layout>
