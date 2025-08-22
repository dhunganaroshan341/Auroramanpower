<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence;

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraphs(3, true),
            'created_by' => 1,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            // Attach random categories (1-3)
            $categoryIds = Category::inRandomOrder()->take(rand(1,3))->pluck('id');
            $post->categories()->sync($categoryIds);

            // Attach random tags (1-3)
            $tagIds = Tag::inRandomOrder()->take(rand(1,3))->pluck('id');
            $post->tags()->sync($tagIds);
        });
    }
}
