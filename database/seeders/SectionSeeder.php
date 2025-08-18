<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SectionCategory;
use App\Models\SectionContent;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        // Create 20 categories
        $categories = SectionCategory::factory()->count(20)->create();

        // Create 50 contents spread across categories
        SectionContent::factory()->count(50)->make()->each(function ($content) use ($categories) {
            $content->section_category_id = $categories->random()->id;
            $content->save();
        });
    }
}
