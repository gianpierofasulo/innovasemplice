<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Http;

use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BreweriesService;

class BreweriesController extends Controller
{

    private BreweriesService $breweriesService;

    public function __construct(BreweriesService $breweriesService)
    {
        $this->breweriesService = $breweriesService;
    }

    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = $request->query('perPage', 10);
        $data = $this->breweriesService->getAll($page, $perPage);
        return response()->json($data);
    }
}
