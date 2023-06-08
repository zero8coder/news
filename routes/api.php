<?php

use App\Http\Controllers\ArticlesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['ip.limit'])->group(function () {
    Route::post('article', [ArticlesController::class, 'store'])->name('article.store');
    Route::post('articles', [ArticlesController::class, 'batchStore'])->name('article.batch.store');
});



