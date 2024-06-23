<?php

namespace App\Http\Controllers;

// Import the CitySearchService class
use App\Services\CitySearchService;
// Import the Request class from Laravel
use Illuminate\Http\Request;

class CitySearchController extends Controller
{
    // Property to hold the CitySearchService instance
    protected $citySearchService;

    // Constructor to inject the CitySearchService dependency
    public function __construct(CitySearchService $citySearchService)
    {
        $this->citySearchService = $citySearchService;
    }

    // Method to handle search requests
    public function search(Request $request)
    {
        // Get the 'q' query parameter from the request
        $query = $request->input('q');

        // Check if the query parameter is missing
        if (!$query) {
            // Return a 400 Bad Request response with an error message
            return response()->json(['error' => 'Query parameter is missing'], 400);
        }

        // Call the searchCity method on the CitySearchService with the query
        $result = $this->citySearchService->searchCity($query);

        // Check if there is an error in the result
        if (isset($result['error'])) {
            // Log the error for debugging purposes
            Log::error('City search error', [
                'error' => $result['error'],
                'message' => $result['message'],
                'status' => $result['status']
            ]);
            // Return a response with the error message and status code
            return response()->json(['error' => $result['error'], 'message' => $result['message']], $result['status']);
        }

        // Return the search result with the appropriate headers
        return response()->json($result['body'], $result['status'])
            ->header('Content-Type', $result['headers'][0]);
    }
}