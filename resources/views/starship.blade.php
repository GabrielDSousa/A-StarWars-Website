<?php
function randomPlanet(){
    $planet = 'planet'.rand("1","21");
    return @svg($planet, ['class' => 'object-contain h-32 w-32']);
}

function randomStarship()
{
    $starship = 'rocket-' . rand("1", "29");
    return @svg($starship, ['class' => 'object-contain h-32 w-32', 'fill' => 'white']);
}

function verifyUnknown($test)
{
    return ($test === "n/a" || $test === "unknown") ? "desconhecido" : $test;
}

?>

<x-app-layout xmlns="http://www.w3.org/1999/html">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white bg-transparent leading-tight">
            {{__('Nave')}}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-4">
        {{--Here is my own code--}}
        <div>
            <div class="max-w-md mx-auto bg-gray-900 rounded-xl shadow-md md:max-w-2xl">
                <div class="flex justify-center">
                    <div class="flex flex-col place-content-between p-8">
                        <div class="place-self-center">
                            {{randomStarship()}}
                        </div>
                        <div>
                            <input type="button" value="Voltar" onClick="history.go(-1)"
                                   class="flex-shrink-0 p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center justify-center space-x-4 text-base font-medium text-white bg-blue-700 hover:bg-indigo-900">
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="uppercase tracking-wide text-sm text-gray-300 font-semibold">{{$responseBody->name}}</div>
                        <p class="mt-2 text-white">Custo em créditos: {{verifyUnknown($responseBody->cost_in_credits)}} créditos</p>
                        <p class="mt-2 text-white">Modelo: {{verifyUnknown($responseBody->model)}}</p>
                        <p class="mt-2 text-white">Fabricante: {{verifyUnknown($responseBody->manufacturer)}}</p>
                        <p class="mt-2 text-white">Comprimento: {{verifyUnknown($responseBody->length)}} metros</p>
                        <p class="mt-2 text-white">Velocidade atmosférica máxima : {{verifyUnknown($responseBody->max_atmosphering_speed)}}</p>
                        <p class="mt-2 text-white">Equipe técnica: {{verifyUnknown($responseBody->crew)}}</p>
                        <p class="mt-2 text-white">Passageiros: {{verifyUnknown($responseBody->passengers)}}</p>
                        <p class="mt-2 text-white">Capacidade de cargo: {{verifyUnknown($responseBody->cargo_capacity)}} habitantes</p>
                        <p class="mt-2 text-white">Tempo de
                            alimentação: {{explode(' ',verifyUnknown($responseBody->consumables))[1] == 'days' ? verifyUnknown($responseBody->consumables)[0].' dias' : verifyUnknown($responseBody->consumables)[0].'anos'}} </p>
                        <p class="mt-2 text-white">Velocidade de hyperdrive: {{verifyUnknown($responseBody->hyperdrive_rating)}} parsecs</p>
                        <p class="mt-2 text-white">MGLT: {{verifyUnknown($responseBody->MGLT)}}</p>
                        <p class="mt-2 text-white">Classe da nave espacial: {{verifyUnknown($responseBody->starship_class)}}</p>

                        <x-form-button :action="route('save', [$type, $id])" method="POST" class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center justify-center space-x-4 text-base font-medium text-white bg-blue-700 hover:bg-indigo-900">
                            Salvar nos favoritos
                        </x-form-button>
                    </div>
                </div>
            </div>
        </div>
        {{--Here is my own code--}}
    </div>
</x-app-layout>




