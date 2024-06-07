<?php

namespace App\Http\Controllers;

use App\Services\CitySearchService;
use Illuminate\Http\Request;

class CitySearchController extends Controller
{
    protected $citySearchService;

    public function __construct(CitySearchService $citySearchService)
    {
        $this->citySearchService = $citySearchService;
    }

    public function search(Request $request)
    {
    $query = $request->input('q');

    if (!$query) {
        return response()->json(['error' => 'Query parameter is missing'], 400);
    }

    $result = $this->citySearchService->searchCity($query);

    if (isset($result['error'])) {
        // Log the error for debugging
        Log::error('City search error', [
            'error' => $result['error'],
            'message' => $result['message'],
            'status' => $result['status']
        ]);
        return response()->json(['error' => $result['error'], 'message' => $result['message']], $result['status']);
    }

    return response()->json($result['body'], $result['status'])
        ->header('Content-Type', $result['headers'][0]);
}

}
