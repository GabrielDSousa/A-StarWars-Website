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
        $url = 'http://swapi.dev/api/' . $type . '/' . $id;
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
        return view("planet", compact('responseBody'));
    }

    public function starship($responseBody)
    {
        return view("starship", compact('responseBody'));
    }

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

        $this->cachePlanets();
        return view('planets', compact('responseBody'));
    }

    public function cachePlanets()
    {
        $client = new Client(); //GuzzleHttp\Client
        $planetNames = array();
        $climateForTranslate = array();
        $terrainForTranslate = array();

        $url = "https://swapi.dev/api/planets/";
        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);
        $responseBody = json_decode($response->getBody());
        $numberOfPages = $responseBody->count / 10;

        for ($i = 1; $i <= $numberOfPages; $i++) {
            $url = "https://swapi.dev/api/planets/?page=" . $i;
            $response = $client->request('GET', $url, [
                'verify' => false,
            ]);
            $responseBody = json_decode($response->getBody());

            foreach ($responseBody->results as $result) {
                $planetNames[] = $result->name;
                $aux = explode(", ", $result->climate);
                foreach ($aux as $a) {
                    if (!in_array($a, $climateForTranslate)) {
                        $climateForTranslate[] = $a;
                    }
                }
                $aux2 = explode(", ", $result->terrain);
                foreach ($aux2 as $a2) {
                    if (!in_array($a2, $terrainForTranslate)) {
                        $terrainForTranslate[] = $a2;
                    }
                }
            }

        }

        //planets
        $encodedString = json_encode($planetNames);
        $handle = fopen ( "D:/Estudo/A-StarWars-Website/resources/views/list/planetNames.txt" , 'wb');
        fwrite ( $handle , $encodedString);
        fclose($handle);

        //terrains
        $encodedString = json_encode($terrainForTranslate);
        $handle = fopen ( "D:/Estudo/A-StarWars-Website/resources/views/list/terrainNames.txt" , 'wb');
        fwrite ( $handle , $encodedString);
        fclose($handle);

        //climates
        $encodedString = json_encode($climateForTranslate);
        $handle = fopen ( "D:/Estudo/A-StarWars-Website/resources/views/list/climateNames.txt" , 'wb');
        fwrite ( $handle , $encodedString);
        fclose($handle);
    }
}
