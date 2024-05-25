<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GatewayController extends Controller
{

    //CITY SEARCH

    public function citySearch(Request $request)
    {
        $query = $request->input('q');
        
        if (!$query) {
            return response()->json(['error' => 'Query parameter is missing'], 400);
        }

        $client = new Client();
        $apiKey = env('RAPIDAPI_KEY');

        try {
            $response = $client->request('GET', 'https://city-and-state-search-api.p.rapidapi.com/search', [
                'headers' => [
                    'X-RapidAPI-Host' => 'city-and-state-search-api.p.rapidapi.com',
                    'X-RapidAPI-Key' => $apiKey,
                ],
                'query' => ['q' => $query],
            ]);

            return response($response->getBody(), $response->getStatusCode())
                ->header('Content-Type', $response->getHeader('Content-Type')[0]);
        } catch (\Exception $e) {
            Log::error('API Request Failed', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);
            return response()->json(['error' => 'Failed to fetch data from the API', 'message' => $e->getMessage()], 500);
        }
    }

    //GET WEATHER

    public function getWeather(Request $request)
    {
        $location = $request->input('location');

        if (!$location) {
            return response()->json(['error' => 'Location parameter is missing'], 400);
        }

        $client = new Client();
        $apiKey = env('RAPIDAPI_KEY');

        try {
            $response = $client->request('GET', 'https://weatherapi-com.p.rapidapi.com/forecast.json', [
                'headers' => [
                    'X-RapidAPI-Host' => 'weatherapi-com.p.rapidapi.com',
                    'X-RapidAPI-Key' => $apiKey,
                ],
                'query' => ['q' => $location],
            ]);

            return $response->getBody(); // Return the response body directly
        } catch (\Exception $e) {
            Log::error('Weather API Request Failed', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);
            return response()->json(['error' => 'Failed to fetch weather data from the API', 'message' => $e->getMessage()], 500);
        }
    }

    //GET PLACE TIME

    public function getTime(Request $request)
    {
        $location = $request->input('location');
        
        if (!$location) {
            return response()->json(['error' => 'Location parameter is missing'], 400);
        }

        // Replace with your actual API key and endpoint URL
        $apiKey = 'fe24a4abdcmsh6b78e71475c7945p119266jsn5b2a99185043';
        $url = 'https://weatherapi-com.p.rapidapi.com/timezone.json?q=' . $location;

        $client = new Client();
        $headers = [
            'X-RapidAPI-Host' => 'weatherapi-com.p.rapidapi.com',
            'X-RapidAPI-Key' => $apiKey,
        ];

        try {
            $response = $client->request('GET', $url, ['headers' => $headers]);
            return response($response->getBody(), $response->getStatusCode());
        } catch (\Exception $e) {
            Log::error('Time API Request Failed', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);
            return response()->json(['error' => 'Failed to fetch time data from the API', 'message' => $e->getMessage()], 500);
        }
    }

    //GET CURRENCY

    public function getCurrency(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $amount = $request->input('amount');
        
        if (!$from || !$to || !$amount) {
            return response()->json(['error' => 'Required parameters are missing'], 400);
        }

        $client = new Client();
        $apiKey = env('RAPIDAPI_KEY');

        try {
            $response = $client->request('GET', 'https://currency-converter-pro1.p.rapidapi.com/convert', [
                'headers' => [
                    'X-RapidAPI-Host' => 'currency-converter-pro1.p.rapidapi.com',
                    'X-RapidAPI-Key' => $apiKey,
                ],
                'query' => [
                    'from' => $from,
                    'to' => $to,
                    'amount' => $amount,
                ],
            ]);

            return response($response->getBody(), $response->getStatusCode())
                ->header('Content-Type', $response->getHeader('Content-Type')[0]);
        } catch (\Exception $e) {
            Log::error('Currency API Request Failed', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);
            return response()->json(['error' => 'Failed to fetch currency data from the API', 'message' => $e->getMessage()], 500);
        }
    }
}
