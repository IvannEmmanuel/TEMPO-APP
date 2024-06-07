<?php

namespace App\Http\Controllers;

use App\Services\WeatherSearchService;
use Illuminate\Http\Request;

class WeatherSearchController extends Controller
{
    protected $weatherSearchService;

    public function __construct(WeatherSearchService $weatherSearchService)
    {
        $this->weatherSearchService = $weatherSearchService;
    }

    public function searchWeather(Request $request)
    {
        $location = $request->input('location');

        if (!$location) {
            return response()->json(['error' => 'Location parameter is missing'], 400);
        }

        $result = $this->weatherSearchService->searchWeather($location);

        if (isset($result['error'])) {
            return response()->json(['error' => $result['error'], 'message' => $result['message']], $result['status']);
        }

        return response($result['body'], $result['status']);
    }
}
