<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

class SwapiControlller extends Controller
{
    /**
     * @param $type
     * @param $page
     * @return Application|Factory|View
     * @throws GuzzleException
     */
    public function showList($type, $page)
    {
        $url = "http://swapi.dev/api/" . $type . "/?page=" . $page;
        $responseBody = $this->responseBody($url);
        $next = $this->haveNext($responseBody);
        $previous = $this->havePrevious($responseBody);
        $name = '';
        if ($type == 'planets') {
            $name = 'Planetas';
        } elseif ($type == 'starships') {
            $name = 'Naves espaciais';
        } elseif ($type == 'favorites') {
            $name = 'Favoritos';
        } else {
            redirect('404');
        }


        return view('list', compact('responseBody', 'next', 'previous', 'name', 'type'));
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
            $explode = explode("=", $responseBody->next);
            $previous = $explode[1];
        }
        return $previous;
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
            return $this->planet($responseBody, $type, $id);
        } elseif ($type == "starships") {
            return $this->starship($responseBody, $type, $id);
        } else {
            return $this->planetsList(1);
        }
    }

    /**
     * @param $responseBody
     * @param $type
     * @param $id
     * @return Application|Factory|View
     */
    public function planet($responseBody, $type, $id)
    {

        //Retrieving and translating climate
        $climates = $responseBody->climate;
        $climates = explode(', ', $climates);
        $climatesTranslated = [];
        foreach ($climates as $climate) {
            if (DB::table('translations')->where('key', $climate)->exists()) {
                $translation = DB::table('translations')->where('key', $climate)->first();
                $climatesTranslated [] = $translation->translation;
            }
        }

        //Retrieving and translating terrain
        $terrains = $responseBody->terrain;
        $terrains = explode(', ', $terrains);
        $terrainsTranslated = [];
        foreach ($terrains as $terrain) {
            if (DB::table('translations')->where('key', $terrain)->exists()) {
                $translation = DB::table('translations')->where('key', $terrain)->first();
                $terrainsTranslated [] = $translation->translation;
            }
        }

        return view("planet", compact('responseBody', 'climatesTranslated', 'terrainsTranslated', 'type', 'id'));
    }

    /**
     * @param $responseBody
     * @param $type
     * @param $id
     * @return Application|Factory|View
     */
    public function starship($responseBody, $type, $id)
    {
        return view("starship", compact('responseBody', 'type', 'id'));
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
     * @param $type
     * @param $id
     * @return Application|RedirectResponse|Redirector
     * @throws GuzzleException
     */
    public function save($type, $id)
    {
        $user = auth()->user();
        $url = 'http://swapi.dev/api/' . $type . '/' . $id;
        $responseBody = $this->responseBody($url);

        try {
            DB::table('favorites')->insert(
                ['url' => $url, 'user_id' => $user->id, 'name' => $responseBody->name]
            );
        } catch (Exception $e) {
            return redirect(route('favorites'));
        }

        return redirect(route('favorites'));
    }

    /**
     * @return Application|Factory|View
     */
    public function favorites()
    {
        $userId = auth()->user()->getAuthIdentifier();
        $query = DB::table('favorites')->where(['user_id' => $userId])->select('id', 'url', 'name');
        $favorites = $query->get();
        return view('favorites', compact('favorites'));
    }

    public function delete($id)
    {
        DB::table('favorites')->delete($id);
        return redirect(route('favorites'));
    }
}
