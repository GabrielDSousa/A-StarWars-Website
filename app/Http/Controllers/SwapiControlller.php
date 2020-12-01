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
        $url = "http://swapi.dev/api/starships/?page=" . $page;
        $responseBody = $this->responseBody($url);

        $next = $this->haveNext($responseBody);
        $previous = $this->havePrevious($responseBody);

        return view('starships', compact('responseBody','next','previous'));
    }

    /**
     * @param string $type
     * @param int $id
     * @return Application|Factory|View
     * @throws GuzzleException
     */
    public function getDetails($type, $id)
    {

        $url = 'http://swapi.dev/api/' . $type . '/' . $id;
        $responseBody = $this->responseBody($url);

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
        $filename = '..\resources\views\list\translationPtBr.json';
        $handle = fopen($filename, 'rb');
        $file = fread ($handle, filesize ($filename));
        $translation = json_decode($file);
        fclose($handle);

        //Retrieving and translating climate
        $climates = $translation->climates;
        $climate = $responseBody->climate;
        if(isset($climates->$climate) != false) {
            $climate = $climates->$climate;
        }

        //Retrieving and translating terrain
        $terrains = $translation->terrains;
        $terrain = $responseBody->terrain;
        if(isset($terrains->$terrain) != false){
            $terrain = $terrains->$terrain;
        }

        return view("planet", compact('responseBody','climate', 'terrain'));
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
        $url = "https://swapi.dev/api/planets/?page=" . $page;
        $responseBody = $this->responseBody($url);

        $next = $this->haveNext($responseBody);
        $previous = $this->havePrevious($responseBody);

        return view('planets', compact('responseBody', 'next', 'previous'));
    }

    /**
     * @param $url
     * @return mixed
     * @throws GuzzleException
     */
    public function responseBody($url)
    {
        $client = new Client(); //GuzzleHttp\Client
        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);
        $responseBody = json_decode($response->getBody());
        return $responseBody;
    }

    /**
     * @param $responseBody
     * @return null|string[]
     */
    public function haveNext($responseBody)
    {
        $next = $responseBody->next;
        if (!is_null($responseBody->next)) {
            $explode = explode("=", $responseBody->next);
            $next = $explode[1];
        }
        return $next;
    }

    /**
     * @param $responseBody
     * @return null|string[]
     */
    public function havePrevious($responseBody)
    {
        $previous = $responseBody->previous;
        if (!is_null($responseBody->previous)) {
            $explode = explode("=", $responseBody->previous);
            $previous = $explode[1];
        }
        return $previous;
    }
}
