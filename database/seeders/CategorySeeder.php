<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Category;

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
