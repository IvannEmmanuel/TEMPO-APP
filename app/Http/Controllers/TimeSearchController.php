<?php

namespace App\Http\Controllers;

// Import the TimeSearchService class
use App\Services\TimeSearchService;
// Import the Request class from Laravel
use Illuminate\Http\Request;

class TimeSearchController extends Controller
{
    // Property to hold the TimeSearchService instance
    protected $timeSearchService;

    // Constructor to inject the TimeSearchService dependency
    public function __construct(TimeSearchService $timeSearchService)
    {
        $this->timeSearchService = $timeSearchService;
    }

    // Method to get the time for a specific location
    public function getTime(Request $request)
    {
        // Get the 'location' parameter from the request
        $location = $request->input('location');

        // Check if the 'location' parameter is missing
        if (!$location) {
            // Return a 400 Bad Request response with an error message
            return response()->json(['error' => 'Location parameter is missing'], 400);
        }

        // Call the getTime method of the TimeSearchService with the location
        $result = $this->timeSearchService->getTime($location);

        // Check if the result contains an error
        if (isset($result['error'])) {
            // Return the error message and status from the result
            return response()->json(['error' => $result['error'], 'message' => $result['message']], $result['status']);
        }

        // Return the time information and status from the result
        return response($result['body'], $result['status']);
    }
}
