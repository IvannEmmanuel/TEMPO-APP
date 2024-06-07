<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\HistoryLog;
use Illuminate\Support\Facades\Log;

class LogHistory
{
    public function handle($request, Closure $next)
    {
        Log::info('Middleware triggered');  // Logging statement for debugging

        $response = $next($request);

        // Get the requested route path
        $routePath = $request->path();

        // Get current route information
        $routeInfo = $request->route();
        $routeAction = is_array($routeInfo) ? ($routeInfo[1]['uses'] ?? 'Unknown') : 'Unknown';

        // Extract just the controller and method name
        if ($routeAction !== 'Unknown') {
            $routeAction = basename(str_replace('\\', '/', $routeAction));
        }

        // Log request and response
        Log::info('Logging request and response');  // Logging statement for debugging

        $log = new HistoryLog();
        $log->request_method = $request->method();
        $log->request_path = $routePath;
        $log->response_status = $response->getStatusCode();
        $log->endpoint = $routeAction;
        $log->save();

        return $response;
    }
}
