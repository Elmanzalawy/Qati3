<?php

namespace Tests\Feature\Article;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_article_can_be_created(): void
    {
        $user = User::factory()->create();
        $article = Article::factory()->create();

        $this->actingAs($user);
        info($article);
        $response = $this->get(route('article.create'));

        $response->assertStatus(200);
    }
}
