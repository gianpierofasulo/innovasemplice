<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Http\Request;

class BreweriesController extends Controller
{
    public function index(Request $request)
    {


            // Parametri di paginazione
            //$page = $request->input('page', 1); // Pagina corrente, di default 1
            $page = $request->query('page', 1);

            $perPage = 10; // Numero di risultati per pagina

            // Effettua la chiamata all'API e ottieni tutti i dati
            $response = Http::get('https://api.openbrewerydb.org/v1/breweries');

            $allBreweries = collect($response->json()); // Converte i dati in una collezione

            // Divide i dati in base alla pagina e al numero di elementi per pagina
            $itemsForCurrentPage = $allBreweries->slice(($page - 1) * $perPage, $perPage)->values();

            // Crea il paginatore per i risultati attuali
            $paginatedBreweries = new LengthAwarePaginator(
                $itemsForCurrentPage,
                $allBreweries->count(),
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );


            // Restituisci i dati
            return ['allItems' => $paginatedBreweries];


     //   return response()->json(['error' => 'Failed to fetch data'], 500);
    }
}
