<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class TimeSearchService
{
    /**
     * The base URI to consume the time API
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
     * Get current time for a given location.
     *
     * @param string $location The location for which to retrieve time information
     * @return array
     */
    public function getTime($location)
    {
        $url = $this->baseUri . '/timezone.json?q=' . $location;
        $headers = [
            'X-RapidAPI-Host' => 'weatherapi-com.p.rapidapi.com',
            'X-RapidAPI-Key' => $this->apiKey,
        ];

        try {
            // Send GET request to time API
            $response = $this->client->request('GET', $url, ['headers' => $headers]);

            // Parse response body and status code
            return [
                'body' => json_decode($response->getBody()->getContents(), true),
                'status' => $response->getStatusCode(),
            ];
        } catch (\Exception $e) {
            // Log error if request fails
            Log::error('Time API Request Failed', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);

            // Return error response
            return [
                'error' => 'Failed to fetch time data from the API',
                'message' => $e->getMessage(),
                'status' => 500,
            ];
        }
    }
}