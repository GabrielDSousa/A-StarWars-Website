<?php
function randomStarship()
{
    $starship = 'rocket-' . rand("1", "29");
    return @svg($starship, ['class' => 'object-contain h-32 w-32']);
}

function verifyUnknown($test)
{
    return ($test === "n/a" || $test === "unknown") ? "desconhecido" : $test;
}

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Nave')}}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-4">
        {{--Here is my own code--}}
        <div>
            <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                <div class="md:flex justify-center">
                    <div class="md:flex-shrink-0 flex flex-col place-content-between p-8">
                        <div>
                            {{randomStarship()}}
                        </div>
                        <div>
                            <input type="button" value="Voltar" onClick="history.go(-1)"
                                   class="flex-shrink-0 p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center justify-center space-x-4 text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{$responseBody->name}}</div>
                        <p class="mt-2 text-gray-500">Custo em créditos: {{verifyUnknown($responseBody->cost_in_credits)}} créditos</p>
                        <p class="mt-2 text-gray-500">Modelo: {{verifyUnknown($responseBody->model)}}</p>
                        <p class="mt-2 text-gray-500">Fabricante: {{verifyUnknown($responseBody->manufacturer)}}</p>
                        <p class="mt-2 text-gray-500">Comprimento: {{verifyUnknown($responseBody->length)}} metros</p>
                        <p class="mt-2 text-gray-500">Velocidade atmosférica máxima : {{verifyUnknown($responseBody->max_atmosphering_speed)}}</p>
                        <p class="mt-2 text-gray-500">Equipe técnica: {{verifyUnknown($responseBody->crew)}}</p>
                        <p class="mt-2 text-gray-500">Passageiros: {{verifyUnknown($responseBody->passengers)}}</p>
                        <p class="mt-2 text-gray-500">Capacidade de cargo: {{verifyUnknown($responseBody->cargo_capacity)}} habitantes</p>
                        <p class="mt-2 text-gray-500">Tempo de
                            alimentação: {{explode(' ',verifyUnknown($responseBody->consumables))[1] == 'days' ? verifyUnknown($responseBody->consumables)[0].' dias' : verifyUnknown($responseBody->consumables)[0].'anos'}} </p>
                        <p class="mt-2 text-gray-500">Velocidade de hyperdrive: {{verifyUnknown($responseBody->hyperdrive_rating)}} parsecs</p>
                        <p class="mt-2 text-gray-500">MGLT: {{verifyUnknown($responseBody->MGLT)}}</p>
                        <p class="mt-2 text-gray-500">Classe da nave espacial: {{verifyUnknown($responseBody->starship_class)}}</p>
                        <a href="/save/{{$type}}/{{$id}}">
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

