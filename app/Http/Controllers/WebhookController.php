<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\ExchangeRate;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('Webhook received:', $request->all());

        $event = $request->input('event');
        if ($event !== 'exchange_rate_updated') {
            Log::warning('Unrecognized event type received: ' . $event);
            return response()->json(['status' => 'ignored'], 200);
        }

        $data = $request->input('data');
        $sourceCurrency = $data['source_currency'] ?? null;
        $targetCurrency = $data['target_currency'] ?? null;
        $newRate = $data['new_rate'] ?? null;

        if (!$sourceCurrency || !$targetCurrency || !$newRate) {
            Log::error('Missing required data for exchange rate update.');
            return response()->json(['error' => 'Invalid data'], 400);
        }

        $exchangeRate = ExchangeRate::updateOrCreate(
            [
                'source_currency' => $sourceCurrency,
                'target_currency' => $targetCurrency,
            ],
            ['rate' => $newRate]
        );

        Log::info("Updated exchange rate for $sourceCurrency to $targetCurrency: $newRate");
        return response()->json(['status' => 'success']);
    }
}
