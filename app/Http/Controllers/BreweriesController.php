<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Client\RequestException;

class BreweriesController extends Controller
{
    public function index(Request $request)
    {
        $token = 'Bearer ' . Session::get('apiToken');

        $data = Http::withToken($token)
            ->get(route('api.breweries.all'),  [
                'page' => $request->page,       // Parametro di pagina
                'per_page' => 10,      // Numero di elementi per pagina
            ])
            ->throw(function (Response $response, RequestException $e) {
                dd($e);
            })->json();

            if ($data) {
                $paginator = new LengthAwarePaginator(
                    $data['data'], // Elementi della pagina corrente
                    $data['total'], // Totale elementi
                    $data['per_page'], // Elementi per pagina
                    $data['current_page'], // Pagina corrente
                    ['path' => url()->current()] // URL base per i link di paginazione
                );

                return view('dashboard', ['items' => $paginator]);

            } else {

                return view('dashboard', ['items' => []]);
            }




    }
}
