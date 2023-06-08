<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleBatchStoreRequest;
use App\Models\Article;
use Carbon\Carbon;
use Exception;
use DB;
use Log;

class ArticlesController extends Controller
{
    public function store(Article $article)
    {
        $article->fill(request()->all());
        $article->save();
        return response()->json(['code' => 200, 'data' => $article]);
    }

    public function batchStore(ArticleBatchStoreRequest $request)
    {
        $data = $request->input('data');
        $chunk_datas = array_chunk($data, 50);
        foreach ($chunk_datas as $chunk_data) {
            DB::beginTransaction();
            try {
                $existTitles = Article::whereIn('title', array_column($chunk_data, 'title'))->pluck('title')->toArray();
                $filteredData = array_filter($chunk_data, function ($item) use ($existTitles) {
                    return !in_array($item['title'], $existTitles);
                });
                foreach ($filteredData as &$item) {
                    $item['created_at'] = Carbon::now();
                    $item['updated_at'] = Carbon::now();
                }
                DB::table('articles')->insert($filteredData);
                DB::commit();
                return response()->json(['code' => 200, 'msg' => '成功']);
            } catch (Exception $e) {
                DB::rollback();
                Log::error('batchStoreError', [$e->getMessage()]);
                return response()->json(['code' => 3001, 'msg' => '失败']);

            }
        }

    }

    public function weibo()
    {
        $weiboHost = 'https://s.weibo.com';
        $weibos = Article::where('source', Article::SOURCE_WEIBO)->where('created_at', '>', Carbon::today()->toDateString())->get();
        return view('weibo', compact('weiboHost', 'weibos'));
    }
}
