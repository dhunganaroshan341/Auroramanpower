<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SectionCategoryFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->unique()->words(2, true);

        return [
            'title' => ucfirst($title),
            'sub_heading' => $this->faker->sentence(4),
            'image' => $this->faker->imageUrl(640, 480, 'business', true),
            'video' => $this->faker->url(),
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(100, 999),
            'description' => $this->faker->paragraph(),
            'description2' => $this->faker->paragraph(),
        ];
    }
}
