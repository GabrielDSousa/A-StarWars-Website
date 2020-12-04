<?php
function randomPlanet()
{
    $planet = 'planet' . rand("1", "21");
    return @svg($planet, ['class' => 'object-contain h-32 w-32']);
}

function verifyUnknown($test)
{
    return ($test === "n/a" || $test === "unknown") ? "desconhecido" : $test;
}

?>

<x-app-layout xmlns="http://www.w3.org/1999/html">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white bg-transparent leading-tight">
            {{__('Planeta')}}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-4">
        {{--Here is my own code--}}
        <div>
            <div class="max-w-md mx-auto bg-gray-900 rounded-xl shadow-md md:max-w-2xl">
                <div class="flex justify-center">
                    <div class="flex flex-col place-content-between p-8">
                        <div class="place-self-center">
                            {{randomPlanet()}}
                        </div>
                        <div>
                            <input type="button" value="Voltar" onClick="history.go(-1)"
                                   class="flex-shrink-0 p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center justify-center space-x-4 text-base font-medium text-white bg-blue-700 hover:bg-indigo-900">
                        </div>
                    </div>
                    <div class="p-8">
                        <div
                            class="uppercase tracking-wide text-sm text-gray-300 font-semibold">{{$responseBody->name}}</div>
                        <p class="mt-2 text-white">Período de rotação: {{verifyUnknown($responseBody->rotation_period)}}
                            dias</p>
                        <p class="mt-2 text-white">Período de órbita: {{verifyUnknown($responseBody->orbital_period)}}
                            dias</p>
                        <p class="mt-2 text-white">Diâmetro: {{verifyUnknown($responseBody->diameter)}} quilômetros</p>
                        <p class="mt-2 text-white">Clima:
                            <?php $i = 0 ?>
                            @foreach($climatesTranslated as $ct)
                                @if($i > 0)
                                    {{', '}}
                                @endif
                                {{$ct}}
                                <?php $i++ ?>
                            @endforeach
                        </p>
                        <p class="mt-2 text-white">Terreno:
                            <?php $i = 0 ?>
                            @foreach($terrainsTranslated as $tt)
                                @if($i > 0)
                                    {{', '}}
                                @endif
                                {{$tt}}
                                <?php $i++ ?>
                            @endforeach
                        </p>
                        <p class="mt-2 text-white">Superfície de água: {{verifyUnknown($responseBody->surface_water)}}
                            %</p>
                        <p class="mt-2 text-white">População: {{verifyUnknown($responseBody->population)}}
                            habitantes</p>

                        <x-form-button :action="route('save', [$type, $id])" method="POST"
                                       class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center justify-center space-x-4 text-base font-medium text-white bg-blue-700 hover:bg-indigo-900">
                            Salvar nos favoritos
                        </x-form-button>
                    </div>
                </div>
            </div>
        </div>
        {{--Here is my own code--}}
    </div>
</x-app-layout>


