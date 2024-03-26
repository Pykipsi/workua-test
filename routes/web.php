<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShortUrlController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/url-minimizer', [ShortUrlController::class, 'show'])->name('show');
Route::post('/minimize', [ShortUrlController::class, 'minimize'])->name('minimize');

Route::get('/statistic/{code}', [ShortUrlController::class, 'statistic'])->name('shorten.statistic');
Route::get('/shorten/{code}', [ShortUrlController::class, 'redirect'])->name('shorten.redirect');
