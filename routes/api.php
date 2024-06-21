<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$mainRoutes = function () {
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/contact-form', [\App\Http\Controllers\ContactUsController::class, 'contactFrom'])->name('contact-form');
};

$aiRoutes = function () {
    Route::get('/translation-results/{hash}', [\App\Http\Controllers\AiController::class, 'translationStatus'])->name('translation-status');
    Route::get('/analysis/{hash}', [\App\Http\Controllers\AiController::class, 'analysis'])->name('analysis');
};


if (config('app.app_localhost')) {
    Route::group(array('domain' => 'ai.localhost'), $aiRoutes);
    Route::group(array('domain' => 'localhost'), $mainRoutes);
} else {
    Route::group(array('domain' => 'ai.aitranslationhub.co'), $aiRoutes);
    Route::group(array('domain' => 'www.aitranslationhub.co'), $mainRoutes);
    Route::group(array('domain' => 'aitranslationhub.co'), $mainRoutes);
}

