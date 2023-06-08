<?php

namespace Tests\Feature;

use App\Http\Controllers\ArticlesController;
use App\Models\Article;
use Tests\TestCase;

class ReadArticleTest extends TestCase
{

   public function test_read_weibo_article()
   {
       Article::factory()->count(50)->create(['source' => 1]);
       $this->get(route('article.weibo'))->assertStatus(200);
   }


}
