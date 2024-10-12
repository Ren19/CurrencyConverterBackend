<?php

namespace App\Http\Controllers;

use App\Models\Conversion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ConversionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'source_currency' => 'required|string|max:3',
            'target_currency' => 'required|string|max:3',
            'original_amount' => 'required|numeric',
        ]);

        $exchangeRate = $this->getExchangeRate($request->source_currency, $request->target_currency);
        if ($exchangeRate === null) {
            return response()->json(['error' => 'Error al obtener la tasa de cambio'], 500);
        }

        $converted_amount = $request->original_amount * $exchangeRate;
        $conversion = Conversion::create([
            'user_id' => Auth::id(),
            'source_currency' => $request->source_currency,
            'target_currency' => $request->target_currency,
            'original_amount' => $request->original_amount,
            'converted_amount' => $converted_amount,
            'created_by' => Auth::id(),
        ]);

        AuditLogController::logAction('CREATE', 'conversions', $conversion->id, null, json_encode($conversion));
        return response()->json($conversion, 201);
    }

    private function getExchangeRate($sourceCurrency, $targetCurrency)
    {
        $apiUrl = "https://api.exchangeratesapi.io/latest?access_key=a09f2af57ab492ab56e1ea4091b2ed64&base={$sourceCurrency}&symbols={$targetCurrency}";

        Log::info("Sending GET request to URL: $apiUrl");

        $response = Http::get($apiUrl);
        
        if ($response->successful()) {
            $data = $response->json();
            return $data['rates'][$targetCurrency] ?? null;
        }
        return null;
    }

    public function index()
    {
        $conversions = Conversion::where('is_active', true)->get();
        return response()->json($conversions);
    }
}
