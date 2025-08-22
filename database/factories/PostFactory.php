<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Tag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'category_id' => $this->faker->numberBetween(1, 5),
            'description' => $this->faker->paragraphs(3, true),
            'created_by' => 1,
        ];
    }

    /**
     * Attach random tags after creating the post.
     */
    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            $tagIds = Tag::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $post->tags()->sync($tagIds);
        });
    }
}
