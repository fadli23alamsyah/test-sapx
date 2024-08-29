<?php

use App\Http\Controllers\PinjamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(PinjamController::class)->group(function () {
    Route::get('/book', 'getBook' );
    Route::get('/pinjam', 'getPinjam' );
    Route::post('/pinjam', 'create');
    Route::put('/pinjam/{id}', 'update');
    Route::delete('/pinjam/{id}', 'delete');
});
