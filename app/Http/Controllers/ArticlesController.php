<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Exception;
use DB;
use Log;

class ArticlesController extends Controller
{
    public function store(Article $article)
    {
        $article->fill(request()->all());
        $article->save();
        return response()->json(['code'=> 200 , 'data' => $article]);
    }

    public function batchStore()
    {
        $chunk_data = array_chunk(request()->all(), 50);
        foreach ($chunk_data as $data) {
            DB::beginTransaction();
            try {
                $existTitles = Article::whereIn('title', array_column($data, 'title'))->pluck('title')->toArray();
                $filteredData = array_filter($data, function ($item) use ($existTitles) {
                    return !in_array($item['title'], $existTitles);
                });
                DB::table('articles')->insert($filteredData);
                DB::commit();
                return response()->json(['code'=> 200 , 'msg' => '成功']);
            } catch (Exception $e) {
                DB::rollback();
                Log::error('batchStore', $e->getMessage());
                return response()->json(['code'=> 3001 , 'msg' => '失败']);

            }
        }
        

        

    }
}
