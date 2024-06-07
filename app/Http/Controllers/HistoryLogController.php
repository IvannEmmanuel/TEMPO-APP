<?php

namespace App\Http\Controllers;

use App\Models\HistoryLog;
use Illuminate\Http\Request;

class HistoryLogController extends Controller
{
    public function index()
    {
        $logs = HistoryLog::all();
        return response()->json($logs);
    }

    public function show($id)
    {
        $log = HistoryLog::find($id);

        if (!$log) {
            return response()->json(['message' => 'Log not found'], 404);
        }

        return response()->json($log);
    }
}
