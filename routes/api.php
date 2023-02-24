<?php

use App\Http\Controllers\LikeArticleController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SaveArticleController;
use App\Http\Controllers\SearchNewsController;
use App\Http\Controllers\ViewedArticleController;
use App\Http\Controllers\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware([
    'weather'
])->group(function() {
    Route::get('/weather/all', [WeatherController::class, 'show']);
    Route::get('/weather/{zip}', [WeatherController::class, 'create']);
});

Route::middleware([
    'news'
])->group(function() {
    Route::get('/news/fetch', [NewsController::class, 'fetch']);

    Route::put('/like', [LikeArticleController::class, 'like']);
    Route::put('/save', [SaveArticleController::class, 'save']);

    Route::post('/viewed', [ViewedArticleController::class, 'viewed']);
    Route::post('/search', [SearchNewsController::class, 'search']);  // primitive search component
});

