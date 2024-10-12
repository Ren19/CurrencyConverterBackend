<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\AuditLogController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth.jwt')->group(function () {
    Route::post('/conversions', [ConversionController::class, 'store']);
    Route::get('/conversions', [ConversionController::class, 'index']);
    Route::post('/webhook', [WebhookController::class, 'handle']);
    Route::get('/audit-log', [AuditLogController::class, 'index']);
});
