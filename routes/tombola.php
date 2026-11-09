<?php

use App\Http\Controllers\TombolaController;
use Illuminate\Support\Facades\Route;

// Stateless endpoints also work inside a cross-site iframe with third-party cookies blocked.
Route::prefix('tombola')->name('tombola.')->group(function (): void {
    Route::post('/status', [TombolaController::class, 'status'])->middleware('throttle:60,1,tombola-read:')->name('status');
    Route::post('/spin', [TombolaController::class, 'spin'])->middleware('throttle:10,1,tombola-spin:')->name('spin');
    Route::post('/result', [TombolaController::class, 'recover'])->middleware('throttle:60,1,tombola-read:')->name('result');
});
