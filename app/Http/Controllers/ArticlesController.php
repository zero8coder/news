<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticlesController extends Controller
{
    public function store(Article $article)
    {
        $article->fill(request()->all());
        $article->save();
        return response()->json(['code'=> 200 , 'data' => $article]);
    }
}
