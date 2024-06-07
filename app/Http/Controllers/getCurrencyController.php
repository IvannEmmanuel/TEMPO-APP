<?php

namespace App\Http\Controllers;

use App\Services\CurrencyService;
use Illuminate\Http\Request;

class getCurrencyController extends Controller
{
    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function getCurrency(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $amount = $request->input('amount');

        if (!$from || !$to || !$amount) {
            return response()->json(['error' => 'Required parameters are missing'], 400);
        }

        $result = $this->currencyService->getCurrency($from, $to, $amount);

        if (isset($result['error'])) {
            return response()->json(['error' => $result['error'], 'message' => $result['message']], $result['status']);
        }

        return response()->json($result['body'], $result['status'])
            ->header('Content-Type', $result['content_type']);
    }
}
