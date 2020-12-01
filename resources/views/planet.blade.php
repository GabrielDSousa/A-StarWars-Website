<?php
function randomPlanet(){
    $planet = 'planet'.rand("1","21");
    return @svg($planet, ['class' => 'object-contain h-32 w-32']);
}

function verifyUnknown($test)
{
    return ($test === "n/a" || $test === "unknown") ? "desconhecido" : $test;
}

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Planeta')}}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-4">
        {{--Here is my own code--}}
        <div>
            <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                <div class="md:flex items-center justify-center">
                    <div class="md:flex-shrink-0">
                        {{randomPlanet()}}
                    </div>
                    <div class="p-8">
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{$responseBody->name}}</div>
                        <p  class="mt-2 text-gray-500">Período de rotação: {{verifyUnknown($responseBody->rotation_period)}} dias</p>
                        <p  class="mt-2 text-gray-500">Período de órbita: {{verifyUnknown($responseBody->orbital_period)}} dias</p>
                        <p  class="mt-2 text-gray-500">Diâmetro: {{verifyUnknown($responseBody->diameter)}} quilômetros</p>
                        <p  class="mt-2 text-gray-500">Clima: {{$climate}}</p>
                        <p  class="mt-2 text-gray-500">Terreno: {{$terrain}}</p>
                        <p  class="mt-2 text-gray-500">Superfície de água: {{verifyUnknown($responseBody->surface_water)}}%</p>
                        <p  class="mt-2 text-gray-500">População: {{verifyUnknown($responseBody->population)}} habitantes</p>
                        <a href="/salvar">
                            <div
                                class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center justify-center space-x-4 text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                                <div class="flex-shrink-0">
                                    Salvar nos favoritos
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{--Here is my own code--}}
    </div>
</x-app-layout>


