<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class WeatherSearchService
{
    /**
     * The base URI to consume the weather API
     * @var string
     */
    public $baseUri;
    public $apiKey;
    public $client;

    public function __construct()
    {
        $this->baseUri = 'https://weatherapi-com.p.rapidapi.com';
        $this->apiKey = env('RAPIDAPI_KEY');
        $this->client = new Client();
    }

    public function searchWeather($location)
    {
        try {
            $response = $this->client->request('GET', $this->baseUri . '/forecast.json', [
                'headers' => [
                    'X-RapidAPI-Host' => 'weatherapi-com.p.rapidapi.com',
                    'X-RapidAPI-Key' => $this->apiKey,
                ],
                'query' => ['q' => $location],
            ]);

            return [
                'body' => json_decode($response->getBody()->getContents(), true),
                'status' => $response->getStatusCode(),
            ];
        } catch (\Exception $e) {
            Log::error('Weather API Request Failed', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);

            return [
                'error' => 'Failed to fetch weather data from the API',
                'message' => $e->getMessage(),
                'status' => 500,
            ];
        }
    }
}
