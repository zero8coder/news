<?php

use App\Http\Controllers\ArticlesController;
use Illuminate\Support\Facades\Route;

Route::get('weibo', [ArticlesController::class, 'weibo'])->name('article.weibo');

