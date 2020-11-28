<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class SwapiControlller extends Controller
{
    /**
     * @param int $page
     * @return Application|Factory|View
     * @throws GuzzleException
     */
    public function planetsList($page)
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = "https://swapi.dev/api/planets/?page=" . $page;

        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return view('planets', compact('responseBody'));
    }

    /**
     * @param int $page
     * @return Application|Factory|View
     * @throws GuzzleException
     */
    public function starshipsList($page)
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = "http://swapi.dev/api/starships/?page=" . $page;

        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return view('starships', compact('responseBody'));
    }

    /**
     * @param string $type
     * @param int $id
     * @return Application|Factory|View
     * @throws GuzzleException
     */
    public function getDetails($type, $id)
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = 'http://swapi.dev/api/'.$type.'/'.$id;
        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        if ($type == "planets") {
            return $this->planet($responseBody);
        } elseif ($type == "starships") {
            return $this->starship($responseBody);
        } else {
            return $this->planetsList(1);
        }
    }

    public function planet($responseBody)
    {
        $notables = [];
        $movies = [];
        foreach ($responseBody->residents as $resident){
            $client = new Client(); //GuzzleHttp\Client
            $url = $resident;
            $responseResident = $client->request('GET', $url, [
                'verify' => false,
            ]);

            $responseBodyResident = json_decode($responseResident->getBody());
            $notables [] = $responseBodyResident->name;
        }

        foreach ($responseBody->films as $film){
            $client = new Client(); //GuzzleHttp\Client
            $url = $film;
            $responseFilm = $client->request('GET', $url, [
                'verify' => false,
            ]);

            $responseBodyFilm = json_decode($responseFilm->getBody());
            $movies [] = $responseBodyFilm->title." episódio: ".$responseBodyFilm->episode_id;
        }

        return view("planet", compact('responseBody', 'movies', 'notables'));
    }

    public function starship($responseBody)
    {
        return view("starship", compact('responseBody'));
    }
}
