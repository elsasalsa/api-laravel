<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

//middlewae auth:sanctum ky middleware IsLogin : untuk route yg diakses setelah login
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/item')->name('item.')->group(function() {
    Route::post('/store', [ItemController::class, 'store'])->name('store');
    Route::get('/', [ItemController::class, 'index'])->name('index');
    Route::get('/show/{id}', [ItemController::class, 'show'])->name('show');
});