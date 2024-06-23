<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CitySearchService
{
    /**
     * The base uri to consume the city search API
     * @var string
     */
    public $baseUri;
    public $apiKey;
    public $client;

    public function __construct()
    {
        $this->baseUri = 'https://city-and-state-search-api.p.rapidapi.com';
        $this->apiKey = env('RAPIDAPI_KEY'); // Retrieve API key from environment variables
        $this->client = new Client(); // Initialize GuzzleHttp client
    }

    /**
     * Search for cities using the provided query.
     *
     * @param string $query
     * @return array
     */
    public function searchCity($query)
    {
        try {
            // Send GET request to city search API
            $response = $this->client->request('GET', $this->baseUri . '/search', [
                'headers' => [
                    'X-RapidAPI-Host' => 'city-and-state-search-api.p.rapidapi.com',
                    'X-RapidAPI-Key' => $this->apiKey,
                ],
                'query' => ['q' => $query], // Query parameters
            ]);

            // Parse response body, status code, and content type headers
            return [
                'body' => json_decode($response->getBody()->getContents(), true),
                'status' => $response->getStatusCode(),
                'headers' => $response->getHeader('Content-Type'),
            ];
        } catch (\Exception $e) {
            // Log error if request fails
            Log::error('API Request Failed', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);

            // Return error response
            return [
                'error' => 'Failed to fetch data from the API',
                'message' => $e->getMessage(),
                'status' => 500,
            ];
        }
    }
}