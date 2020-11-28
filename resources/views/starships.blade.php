<?php
$next = $responseBody->next;
$previous = $responseBody->previous;
if (!is_null($responseBody->next)) {
    $explode = explode("=", $responseBody->next);
    $next = $explode[1];
}

if (!is_null($responseBody->previous)) {
    $explode = explode("=", $responseBody->previous);
    $previous = $explode[1];
}
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Naves') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @foreach ($responseBody->results as $response)
                    <a href="/details/{{explode("http://swapi.dev/api/", $response->url)[1]}}">
                        <div class="col-xl-3 col-md-6 mb-4 hvr-grow ">
                            <div class="card shadow  py-0 rounded-lg ">
                                <div class="card-body py-2 px-2">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div
                                                class=" font-weight-bold mb-4 mt- 2 text-primary text-center text-uppercase mb-1">
                                                {{ $response->name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
                <div class="flex flex-row flex-wrap justify-between">
                    <div @if(is_null($previous)) class="invisible" @endif>
                        <a href="/starships/{{$previous}}" class="">
                            <div
                                class="rounded-md shadow border border-transparent text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                Anterior
                            </div>
                        </a>
                    </div>
                    <div @if(is_null($next)) class="invisible" @endif>
                        <a href="/starships/{{$next}}" class="">
                            <div
                                class="rounded-md shadow border border-transparent text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                Próximo
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
