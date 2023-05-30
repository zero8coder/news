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
            ->assertSee($article->title)
            ->assertSee($article->content)
            ->assertSee('url')
            ->assertSee($article->source);

    }
}
