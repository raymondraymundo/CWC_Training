<?php

namespace Tests\Unit;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;
use App\Repositories\Article\ArticleRepository;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Tests\TestCase;

class ArticleRepositoryUnitTest extends TestCase
{
    use MakesHttpRequests, WithFaker;

    // Get Article
    public function test_it_can_get_all_the_articles()
    {
        Article::factory(3)->create();

        $repository = new ArticleRepository(new Article);
        $articles = $repository->get();

        $this->assertInstanceOf(Collection::class, $articles);
    }

    // Paginate Article
    public function test_it_can_paginate_the_articles()
    {
        Article::factory(3)->create();

        $repository = new ArticleRepository(new Article);
        $articles = $repository->paginate(10);

        $this->assertInstanceOf(Jsonable::class, $articles);
    }

    // Article Data
    protected function articleRequest()
    {
        $articleCategory = ArticleCategory::factory()->create();
        $user = User::factory()->create();

        return new Request([
            'article_category_id' => $articleCategory->id,
            'title' => fake()->unique()->name,
            'slug' => fake()->unique()->isbn10,
            'contents' => fake()->text,
            'image' => UploadedFile::fake()->image('image.jpg', 640, 480)->size(100),
            'user_id' => $user->id,
        ]);
    }

    // Create Article
    public function test_it_can_create_the_article()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $repository = new ArticleRepository(new Article);
        $article = $repository->create($this->articleRequest());

        $this->assertInstanceOf(Article::class, $article);
    }

    public function test_it_throws_error_when_creating_the_article()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->expectException(InvalidArgumentException::class);

        $repository = new ArticleRepository(new Article);
        $repository->create(new Request([]));
    }

    // Find Article
    public function test_it_can_find_the_article()
    {
        $article = Article::factory()->create();

        $repository = new ArticleRepository(new Article);
        $foundArticle = $repository->find($article->id);

        $this->assertInstanceOf(Article::class, $foundArticle);
        $this->assertEquals($article->slug, $foundArticle->slug);
    }

    public function test_it_throws_error_when_finding_the_article()
    {
        $this->expectException(ModelNotFoundException::class);

        $repository = new ArticleRepository(new Article);
        $repository->find($this->faker->randomNumber(9));
    }

    // Update Article
    public function test_it_can_update_the_article()
    {
        $article = Article::factory()->create();

        $repository = new ArticleRepository(new Article);
        $updatedArticle = $repository->update($data = $this->articleRequest(), $article->id);

        $this->assertInstanceOf(Article::class, $updatedArticle);
        $this->assertEquals($updatedArticle->slug, $data['slug']);
    }

    public function test_it_throws_error_when_updating_the_article()
    {
        $this->expectException(InvalidArgumentException::class);

        $article = Article::factory()->create();

        $repository = new ArticleRepository(new Article);
        $repository->update(new Request([]), $article->id);
    }

    // Delete Article
    public function test_it_can_delete_the_article()
    {
        $article = Article::factory()->create();

        $repository = new ArticleRepository(new Article);
        $deletedArticle = $repository->delete($article->id);

        $this->assertInstanceOf(Article::class, $deletedArticle);
        $this->assertEquals($article->slug, $deletedArticle->slug);
    }

    public function test_it_throws_error_when_deleting_the_article()
    {
        $this->expectException(ModelNotFoundException::class);

        $repository = new ArticleRepository(new Article);
        $repository->delete($this->faker->randomNumber(9));
    }
}
