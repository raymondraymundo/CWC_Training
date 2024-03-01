<?php

namespace Database\Factories;

use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $articleCategory = ArticleCategory::factory()->create();
        $user = User::factory()->create();

        return [
            'article_category_id' => $articleCategory->id,
            'title' => fake()->unique()->name,
            'slug' => fake()->unique()->isbn10,
            'contents' => fake()->text,
            'image_path' => fake()->imageUrl(640, 480),
            'user_id' => $user->id,
        ];
    }
}
