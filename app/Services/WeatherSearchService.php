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
        $this->apiKey = env('RAPIDAPI_KEY'); // Retrieve API key from environment variables
        $this->client = new Client(); // Initialize GuzzleHttp client
    }

    /**
     * Search weather information for a given location.
     *
     * @param string $location The location for which to retrieve weather information
     * @return array
     */
    public function searchWeather($location)
    {
        try {
            // Send GET request to weather API
            $response = $this->client->request('GET', $this->baseUri . '/forecast.json', [
                'headers' => [
                    'X-RapidAPI-Host' => 'weatherapi-com.p.rapidapi.com',
                    'X-RapidAPI-Key' => $this->apiKey,
                ],
                'query' => ['q' => $location],
            ]);

            // Parse response body and status code
            return [
                'body' => json_decode($response->getBody()->getContents(), true),
                'status' => $response->getStatusCode(),
            ];
        } catch (\Exception $e) {
            // Log error if request fails
            Log::error('Weather API Request Failed', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);

            // Return error response
            return [
                'error' => 'Failed to fetch weather data from the API',
                'message' => $e->getMessage(),
                'status' => 500,
            ];
        }
    }
}