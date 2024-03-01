<?php

namespace Tests\Unit;

use App\Models\ArticleCategory;
use App\Models\User;
use App\Repositories\ArticleCategory\ArticleCategoryRepository;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Tests\TestCase;

class ArticleCategoryRepositoryUnitTest extends TestCase
{
    use MakesHttpRequests, WithFaker;

    // Get Article Category
    public function test_it_can_get_all_the_article_categories()
    {
        ArticleCategory::factory(3)->create();

        $repository = new ArticleCategoryRepository(new ArticleCategory);
        $articleCategories = $repository->get();

        $this->assertInstanceOf(Collection::class, $articleCategories);
    }

    // Paginate Article Category
    public function test_it_can_paginate_the_article_categories()
    {
        ArticleCategory::factory(3)->create();

        $repository = new ArticleCategoryRepository(new ArticleCategory);
        $articleCategories = $repository->paginate(10);

        $this->assertInstanceOf(Jsonable::class, $articleCategories);
    }

    // Article Category Data
    protected function articleCategoryData()
    {
        return [
            'name' => fake()->unique()->name,
        ];
    }

    // Create Article Category
    public function test_it_can_create_the_article_category()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $repository = new ArticleCategoryRepository(new ArticleCategory);
        $articleCategory = $repository->create($this->articleCategoryData());

        $this->assertInstanceOf(ArticleCategory::class, $articleCategory);
    }

    public function test_it_throws_error_when_creating_the_article_category()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->expectException(InvalidArgumentException::class);

        $repository = new ArticleCategoryRepository(new ArticleCategory);
        $repository->create([]);
    }

    // Find Article Category
    public function test_it_can_find_the_article_category()
    {
        $articleCategory = ArticleCategory::factory()->create();

        $repository = new ArticleCategoryRepository(new ArticleCategory);
        $foundArticleCategory = $repository->find($articleCategory->id);

        $this->assertInstanceOf(ArticleCategory::class, $foundArticleCategory);
        $this->assertEquals($articleCategory->name, $foundArticleCategory->name);
    }

    public function test_it_throws_error_when_finding_the_article_category()
    {
        $this->expectException(ModelNotFoundException::class);

        $repository = new ArticleCategoryRepository(new ArticleCategory);
        $repository->find($this->faker->randomNumber(9));
    }

    // Update Article Category
    public function test_it_can_update_the_article_category()
    {
        $articleCategory = ArticleCategory::factory()->create();

        $repository = new ArticleCategoryRepository(new ArticleCategory);
        $updatedArticleCategory = $repository->update($data = $this->articleCategoryData(), $articleCategory->id);

        $this->assertInstanceOf(ArticleCategory::class, $updatedArticleCategory);
        $this->assertEquals($updatedArticleCategory->name, $data['name']);
    }

    public function test_it_throws_error_when_updating_the_article_category()
    {
        $this->expectException(ModelNotFoundException::class);

        $repository = new ArticleCategoryRepository(new ArticleCategory);
        $repository->update([], $this->faker->randomNumber(9));
    }

    // Delete Article Category
    public function test_it_can_delete_the_article_category()
    {
        $articleCategory = ArticleCategory::factory()->create();

        $repository = new ArticleCategoryRepository(new ArticleCategory);
        $deletedArticleCategory = $repository->delete($articleCategory->id);

        $this->assertInstanceOf(ArticleCategory::class, $deletedArticleCategory);
        $this->assertEquals($articleCategory->name, $deletedArticleCategory->name);
    }

    public function test_it_throws_error_when_deleting_the_article_category()
    {
        $this->expectException(ModelNotFoundException::class);

        $repository = new ArticleCategoryRepository(new ArticleCategory);
        $repository->delete($this->faker->randomNumber(9));
    }
}
