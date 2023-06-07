<?php

namespace Tests\Feature;

use App\Models\Article;
use Tests\TestCase;

class AddArticleTest extends TestCase
{
    /**
     * 添加文章
     */
    public function test_add_article()
    {
        $article = Article::factory()->make();
        $response =  $this->post(route('article.store'), $article->toArray());
        $response->assertStatus(200)
            ->assertSee($article->no)
            ->assertSee($article->title)
            ->assertSee($article->content)
            ->assertSee('url')
            ->assertSee($article->source);
    }

    /**
     * 批量插入文章
     */
    public function test_batch_add_article()
    {
        $articles = Article::factory()->count(50)->make();
        $response = $this->post(route('article.batch.store'), ['data' => $articles->toArray()]);
        $response->assertStatus(200);
    }
}
