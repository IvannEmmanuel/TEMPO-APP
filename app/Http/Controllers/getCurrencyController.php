<?php

namespace App\Http\Controllers;

// Import the CurrencyService class
use App\Services\CurrencyService;
// Import the Request class from Laravel
use Illuminate\Http\Request;

class getCurrencyController extends Controller
{
    // Property to hold the CurrencyService instance
    protected $currencyService;

    // Constructor to inject the CurrencyService dependency
    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    // Method to handle currency conversion requests
    public function getCurrency(Request $request)
    {
        // Get 'from' currency parameter from the request
        $from = $request->input('from');
        // Get 'to' currency parameter from the request
        $to = $request->input('to');
        // Get 'amount' parameter from the request
        $amount = $request->input('amount');

        // Check if any of the required parameters are missing
        if (!$from || !$to || !$amount) {
            // Return a 400 Bad Request response with an error message
            return response()->json(['error' => 'Required parameters are missing'], 400);
        }

        // Call the getCurrency method on the CurrencyService with the parameters
        $result = $this->currencyService->getCurrency($from, $to, $amount);

        // Check if there is an error in the result
        if (isset($result['error'])) {
            // Return a response with the error message and status code
            return response()->json(['error' => $result['error'], 'message' => $result['message']], $result['status']);
        }

        // Return the currency conversion result with the appropriate headers
        return response()->json($result['body'], $result['status'])
            ->header('Content-Type', $result['content_type']);
    }
}
