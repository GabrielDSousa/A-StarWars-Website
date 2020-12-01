<?php
function randomStarship(){
    $starship = 'rocket-'.rand("1","29");
    return @svg($starship, ['class' => 'object-contain h-12 w-12']);
}
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Planetas') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-4">
        {{--Here is my own code--}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($responseBody->results as $response)
                <div>
                    <a href="/details/{{explode("http://swapi.dev/api/", $response->url)[1]}}">
                        <div class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                {{randomStarship()}}
                            </div>
                            <div>
                                <div class="text-xl font-medium text-black">{{ $response->name }}</div>
                                <p class="text-gray-500">Ver mais</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

            <div @if(is_null($previous)) class="invisible" @endif>
                <a href="/starships/{{$previous}}" >
                    <div class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center justify-center space-x-4 text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                        <div class="flex-shrink-0">
                            Anterior
                        </div>
                    </div>
                </a>
            </div>

            <div @if(is_null($next)) class="invisible" @endif>
                <a href="/starships/{{$next}}" class="">
                    <div class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center justify-center  space-x-4 text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
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
