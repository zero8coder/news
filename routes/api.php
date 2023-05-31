<?php

use App\Http\Controllers\ArticlesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('api')->group(function() {
    Route::post('article', [ArticlesController::class, 'store'])->name('article.store')->middleware('ip.limit');
    Route::post('articles', [ArticlesController::class, 'batchStore'])->name('article.batch.store')->middleware('ip.limit');

});
