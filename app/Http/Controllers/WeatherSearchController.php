<?php

namespace App\Http\Controllers;

// Import the WeatherSearchService class
use App\Services\WeatherSearchService;
// Import the Request class from Laravel
use Illuminate\Http\Request;

class WeatherSearchController extends Controller
{
    // Property to hold the WeatherSearchService instance
    protected $weatherSearchService;

    // Constructor to inject the WeatherSearchService dependency
    public function __construct(WeatherSearchService $weatherSearchService)
    {
        $this->weatherSearchService = $weatherSearchService;
    }

    // Method to search for weather information for a specific location
    public function searchWeather(Request $request)
    {
        // Get the 'location' parameter from the request
        $location = $request->input('location');

        // Check if the 'location' parameter is missing
        if (!$location) {
            // Return a 400 Bad Request response with an error message
            return response()->json(['error' => 'Location parameter is missing'], 400);
        }

        // Call the searchWeather method of the WeatherSearchService with the location
        $result = $this->weatherSearchService->searchWeather($location);

        // Check if the result contains an error
        if (isset($result['error'])) {
            // Return the error message and status from the result
            return response()->json(['error' => $result['error'], 'message' => $result['message']], $result['status']);
        }

        // Return the weather information and status from the result
        return response($result['body'], $result['status']);
    }
}
