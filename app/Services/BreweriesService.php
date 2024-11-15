<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class BreweriesService
{

    public function getAll(int $currentPage, int $perPage)
    {

        $response = Http::get('https://api.openbrewerydb.org/v1/breweries');

        if ($response->successful()) {
            
            $data = collect($response->json());
        
            $paginated = $data->forPage($currentPage, $perPage);

            return ([
                'data' => $paginated->values(),
                'current_page' => $currentPage,
                'per_page' => $perPage,
                'total' => $data->count(),
            ]);

        } else {
            // Gestisci l'errore
            return response()->json(['error' => 'API call failed', 'details' => $response->body()], $response->status());
        }
    }
}