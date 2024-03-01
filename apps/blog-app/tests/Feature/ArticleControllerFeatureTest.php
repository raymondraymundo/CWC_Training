<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerFeatureTest extends TestCase
{
    use WithFaker;

    // index
    public function test_it_can_display_the_articles_list_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('articles.index'))
            ->assertStatus(200)
            ->assertSee('List of Article');
    }

    public function test_it_redirects_to_login_page_when_displaying_the_articles_list_page_while_user_still_logged_out()
    {
        $this->get(route('articles.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login.index'));
    }

    // create
    public function test_it_can_display_the_create_article_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('articles.create'))
            ->assertStatus(200)
            ->assertSee('Create Article');
    }

    public function test_it_redirects_to_login_page_when_displaying_the_create_article_page_while_user_still_logged_out()
    {
        $this->get(route('articles.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login.index'));
    }

    // Article Data
    protected function articleData()
    {
        $articleCategory = ArticleCategory::factory()->create();
        $user = User::factory()->create();

        return [
            'article_category_id' => $articleCategory->id,
            'title' => fake()->unique()->name,
            'slug' => fake()->unique()->isbn10,
            'contents' => fake()->text,
            'image' => UploadedFile::fake()->image('image.jpg', 640, 480)->size(100),
            'user_id' => $user->id,
        ];
    }
    
    // store
    public function test_it_can_create_the_article()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('articles.store'), $this->articleData())
            ->assertStatus(302)
            ->assertRedirect(route('articles.create'))
            ->assertSessionHas(['message' => 'Article is successfully added.']);
    }

    public function test_it_throws_validation_error_when_creating_the_article()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('articles.store'), [])
            ->assertSessionHas(['errors']);
    }

    public function test_it_redirects_to_login_page_when_creating_the_article_while_user_still_logged_out()
    {
        $this->post(route('articles.store'), $this->articleData())
            ->assertStatus(302)
            ->assertRedirect(route('login.index'));
    }

    // edit
    public function test_it_can_display_the_edit_article_page()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create();

        $this->actingAs($user)
            ->get(route('articles.edit', ['article' => $article->id]))
            ->assertStatus(200)
            ->assertSee('Edit Article');
    }

    public function test_it_throws_model_not_found_error_when_displaying_the_edit_article_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('articles.edit', ['article' => $this->faker->randomNumber(9)]))
            ->assertStatus(404);
    }

    public function test_it_redirects_to_login_page_when_displaying_the_edit_article_page_while_user_still_logged_out()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create();

        $this->get(route('articles.edit', ['article' => $article->id]))
            ->assertStatus(302)
            ->assertRedirect(route('login.index'));
    }

    // update
    public function test_it_can_update_the_article()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create();

        $this->actingAs($user)
            ->put(route('articles.update', ['article' => $article->id]), $this->articleData())
            ->assertStatus(302)
            ->assertRedirect(route('articles.edit', ['article' => $article->id]))
            ->assertSessionHas(['message' => 'Article is successfully updated.']);
    }

    public function test_it_throws_validation_error_when_updating_the_article()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create();

        $this->actingAs($user)
            ->put(route('articles.update', ['article' => $article->id]), [])
            ->assertSessionHas(['errors']);
    }

    public function test_it_throws_model_not_found_error_when_updating_the_article()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->put(route('articles.update', ['article' => $this->faker->randomNumber(9)]), $this->articleData())
            ->assertStatus(404);
    }

    public function test_it_redirects_to_login_page_when_updating_the_article_while_user_still_logged_out()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create();

        $this->put(route('articles.update', ['article' => $article->id]), $this->articleData())
            ->assertStatus(302)
            ->assertRedirect(route('login.index'));
    }

    // destroy
    public function test_it_can_delete_the_article()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create();

        $this->actingAs($user)
            ->delete(route('articles.destroy', ['article' => $article->id]))
            ->assertStatus(302)
            ->assertRedirect(route('articles.index'))
            ->assertSessionHas(['message' => 'Article is successfully deleted.']);
    }

    public function test_it_throws_model_not_found_error_when_deleting_the_article()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->delete(route('articles.destroy', ['article' => $this->faker->randomNumber(9)]))
            ->assertStatus(404);
    }

    public function test_it_redirects_to_login_page_when_deleting_the_article_while_user_still_logged_out()
    {
        $article = Article::factory()->create();

        $this->delete(route('articles.destroy', ['article' => $article->id]))
            ->assertStatus(302)
            ->assertRedirect(route('login.index'));
    }
}
