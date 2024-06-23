<?php

namespace App\Http\Controllers;

// Import the HistoryLog model
use App\Models\HistoryLog;
// Import the Request class from Laravel
use Illuminate\Http\Request;

class HistoryLogController extends Controller
{
    // Method to retrieve all history logs
    public function index()
    {
        // Get all history logs from the database
        $logs = HistoryLog::all();
        // Return the logs as a JSON response
        return response()->json($logs);
    }

    // Method to retrieve a specific history log by its ID
    public function show($id)
    {
        // Find the history log by its ID
        $log = HistoryLog::find($id);

        // Check if the log was not found
        if (!$log) {
            // Return a 404 Not Found response with an error message
            return response()->json(['message' => 'Log not found'], 404);
        }

        // Return the found log as a JSON response
        return response()->json($log);
    }
}