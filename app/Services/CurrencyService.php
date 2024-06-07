<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CurrencyService
{
    /**
     * The base URI to consume the currency API
     * @var string
     */
    public $baseUri;
    public $apiKey;
    public $client;

    public function __construct()
    {
        $this->baseUri = 'https://currency-converter-pro1.p.rapidapi.com';
        $this->apiKey = env('RAPIDAPI_KEY');
        $this->client = new Client();
    }

    public function getCurrency($from, $to, $amount)
    {
        $url = $this->baseUri . '/convert';
        $headers = [
            'X-RapidAPI-Host' => 'currency-converter-pro1.p.rapidapi.com',
            'X-RapidAPI-Key' => $this->apiKey,
        ];
        $query = [
            'from' => $from,
            'to' => $to,
            'amount' => $amount,
        ];

        try {
            $response = $this->client->request('GET', $url, [
                'headers' => $headers,
                'query' => $query,
            ]);

            return [
                'body' => json_decode($response->getBody()->getContents(), true),  // Decode the response to an array
                'status' => $response->getStatusCode(),
                'content_type' => $response->getHeader('Content-Type')[0]
            ];
        } catch (\Exception $e) {
            Log::error('Currency API Request Failed', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);

            return [
                'error' => 'Failed to fetch currency data from the API',
                'message' => $e->getMessage(),
                'status' => 500,
            ];
        }
    }
}
