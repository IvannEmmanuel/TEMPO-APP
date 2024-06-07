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
        $this->apiKey = env('RAPIDAPI_KEY');
        $this->client = new Client();
    }

    public function getTime($location)
    {
        $url = $this->baseUri . '/timezone.json?q=' . $location;
        $headers = [
            'X-RapidAPI-Host' => 'weatherapi-com.p.rapidapi.com',
            'X-RapidAPI-Key' => $this->apiKey,
        ];

        try {
            $response = $this->client->request('GET', $url, ['headers' => $headers]);
            return [
                'body' => json_decode($response->getBody()->getContents(), true),
                'status' => $response->getStatusCode(),
            ];
        } catch (\Exception $e) {
            Log::error('Time API Request Failed', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);

            return [
                'error' => 'Failed to fetch time data from the API',
                'message' => $e->getMessage(),
                'status' => 500,
            ];
        }
    }
}
