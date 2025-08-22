<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
    'Career Advice',
    'Industry Insights',
    'Employee Management',
    'Training & Development',
    'Company Updates',
];

foreach ($categories as $category) {
    Category::updateOrCreate(
        ['slug' => Str::slug($category)],
        [
            'title' => $category,
            'slug' => Str::slug($category),
            'status' => 'Active', // adjust if your schema uses 1/0
        ]
    );
}

    }
}
