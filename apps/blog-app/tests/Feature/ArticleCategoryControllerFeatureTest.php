<?php

namespace Tests\Feature;

use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleCategoryControllerFeatureTest extends TestCase
{
    use WithFaker;

    // index
    public function test_it_can_display_the_article_categories_list_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('article_categories.index'))
            ->assertStatus(200)
            ->assertSee('List of Article Categories');
    }

    public function test_it_redirects_to_login_page_when_displaying_the_article_categories_list_page_while_user_still_logged_out()
    {
        $this->get(route('article_categories.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login.index'));
    }

    // create
    public function test_it_can_display_the_create_article_category_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('article_categories.create'))
            ->assertStatus(200)
            ->assertSee('Create Article Category');
    }

    public function test_it_redirects_to_login_page_when_displaying_the_create_article_category_page_while_user_still_logged_out()
    {
        $this->get(route('article_categories.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login.index'));
    }

    // Article Category Data
    protected function articleCategoryData()
    {
        return [
            'name' => fake()->unique()->name,
        ];
    }
    
    // store
    public function test_it_can_create_the_article_category()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('article_categories.store'), $this->articleCategoryData())
            ->assertStatus(302)
            ->assertRedirect(route('article_categories.create'))
            ->assertSessionHas(['message' => 'Article Category was successfully created.']);
    }

    public function test_it_throws_validation_error_when_creating_the_article_category()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('article_categories.store'), [])
            ->assertSessionHas(['errors']);
    }

    public function test_it_redirects_to_login_page_when_creating_the_article_category_while_user_still_logged_out()
    {
        $this->post(route('article_categories.store'), $this->articleCategoryData())
            ->assertStatus(302)
            ->assertRedirect(route('login.index'));
    }

    // edit
    public function test_it_can_display_the_edit_article_category_page()
    {
        $user = User::factory()->create();
        $articleCategory = ArticleCategory::factory()->create();

        $this->actingAs($user)
            ->get(route('article_categories.edit', ['article_category' => $articleCategory->id]))
            ->assertStatus(200)
            ->assertSee('Edit Article Category');
    }

    public function test_it_throws_model_not_found_error_when_displaying_the_edit_article_category_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('article_categories.edit', ['article_category' => $this->faker->randomNumber(9)]))
            ->assertStatus(404);
    }

    public function test_it_redirects_to_login_page_when_displaying_the_edit_article_category_page_while_user_still_logged_out()
    {
        $user = User::factory()->create();
        $articleCategory = ArticleCategory::factory()->create();

        $this->get(route('article_categories.edit', ['article_category' => $articleCategory->id]))
            ->assertStatus(302)
            ->assertRedirect(route('login.index'));
    }

    // update
    public function test_it_can_update_the_article_category()
    {
        $user = User::factory()->create();
        $articleCategory = ArticleCategory::factory()->create();

        $this->actingAs($user)
            ->put(route('article_categories.update', ['article_category' => $articleCategory->id]), $this->articleCategoryData())
            ->assertStatus(302)
            ->assertRedirect(route('article_categories.edit', ['article_category' => $articleCategory->id]))
            ->assertSessionHas(['message' => 'Article Category was successfully updated.']);
    }

    public function test_it_throws_validation_error_when_updating_the_article_category()
    {
        $user = User::factory()->create();
        $articleCategory = ArticleCategory::factory()->create();

        $this->actingAs($user)
            ->put(route('article_categories.update', ['article_category' => $articleCategory->id]), [])
            ->assertSessionHas(['errors']);
    }

    public function test_it_throws_model_not_found_error_when_updating_the_article_category()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->put(route('article_categories.update', ['article_category' => $this->faker->randomNumber(9)]), $this->articleCategoryData())
            ->assertStatus(404);
    }

    public function test_it_redirects_to_login_page_when_updating_the_article_category_while_user_still_logged_out()
    {
        $user = User::factory()->create();
        $articleCategory = ArticleCategory::factory()->create();

        $this->put(route('article_categories.update', ['article_category' => $articleCategory->id]), $this->articleCategoryData())
            ->assertStatus(302)
            ->assertRedirect(route('login.index'));
    }

    // destroy
    public function test_it_can_delete_the_article_categories()
    {
        $user = User::factory()->create();
        $articleCategory = ArticleCategory::factory()->create();

        $this->actingAs($user)
            ->delete(route('article_categories.destroy', ['article_category' => $articleCategory->id]))
            ->assertStatus(302)
            ->assertRedirect(route('article_categories.index'))
            ->assertSessionHas(['message' => 'Article Category was successfully deleted.']);
    }

    public function test_it_throws_model_not_found_error_when_deleting_the_article_categories()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->delete(route('article_categories.destroy', ['article_category' => $this->faker->randomNumber(9)]))
            ->assertStatus(404);
    }

    public function test_it_redirects_to_login_page_when_deleting_the_article_categories_while_user_still_logged_out()
    {
        $articleCategory = ArticleCategory::factory()->create();

        $this->delete(route('article_categories.destroy', ['article_category' => $articleCategory->id]))
            ->assertStatus(302)
            ->assertRedirect(route('login.index'));
    }
}
