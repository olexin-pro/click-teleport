<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [\App\Http\Controllers\PublicController::class, 'home'])
    ->name('home');



Route::get('/url/qr/{shortURL:url_key}', [\App\Http\Controllers\UrlController::class, 'qr'])
    ->name('url.qr');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    Route::get('/dashboard', [DashboardController::class, 'main'])
        ->name('dashboard');


    Route::post('/dashboard/url/store', [\App\Http\Controllers\UrlController::class, 'store'])
        ->name('dashboard.url.store');


});
