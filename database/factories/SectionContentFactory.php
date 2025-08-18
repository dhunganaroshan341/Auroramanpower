<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SectionCategory;

class SectionContentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'section_category_id' => SectionCategory::inRandomOrder()->first()?->id ?? 1,
            'title' => $this->faker->sentence(3),
            'status' => "Active",
            'short_description' => $this->faker->sentence(6),
            'image' => $this->faker->imageUrl(640, 480, 'tech', true),
            'video' => $this->faker->url(),
            'pdf' => $this->faker->url(),
            'order' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->paragraph(),
            'description2' => $this->faker->paragraph(),
            'icon_class' => 'fas fa-' . $this->faker->word(),
            'link_title' => $this->faker->words(2, true),
            'link_url' => $this->faker->url(),
        ];
    }
}
