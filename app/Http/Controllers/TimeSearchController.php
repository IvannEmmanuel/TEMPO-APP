<?php

namespace App\Http\Controllers;

use App\Services\TimeSearchService;
use Illuminate\Http\Request;

class TimeSearchController extends Controller
{
    protected $timeSearchService;

    public function __construct(TimeSearchService $timeSearchService)
    {
        $this->timeSearchService = $timeSearchService;
    }

    public function getTime(Request $request)
    {
        $location = $request->input('location');

        if (!$location) {
            return response()->json(['error' => 'Location parameter is missing'], 400);
        }

        $result = $this->timeSearchService->getTime($location);

        if (isset($result['error'])) {
            return response()->json(['error' => $result['error'], 'message' => $result['message']], $result['status']);
        }

        return response($result['body'], $result['status']);
    }
}
