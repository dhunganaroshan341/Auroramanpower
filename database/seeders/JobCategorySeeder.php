<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\JobCategory;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Logistics',
                'description' => 'Drivers, Trailer, Crane Operators, Excavator Operators, Mechanics (Diesel & Petrol)',
                'icon_class' => 'icon-15',
            ],
            [
                'name' => 'Construction',
                'description' => 'Engineers, Surveyor, Quantity Surveyor, Safety Officers, Supervisors, Foreman, Electricians, Masons, Carpenters, Helpers, and more.',
                'icon_class' => 'icon-11',
            ],
            [
                'name' => 'Hospitality',
                'description' => 'Managers, Accountants, Secretaries, Waiters, Cooks, Cashiers, Housekeepers, Marketing Executives, and more.',
                'icon_class' => 'icon-10',
            ],
            [
                'name' => 'Technician',
                'description' => 'Plant Technician, Chiller Plant Technician, A/C Technician, Materials & Concrete Technician, Duct Technician.',
                'icon_class' => 'icon-11',
            ],
            [
                'name' => 'Security Guards',
                'description' => 'Security Officers, Supervisors, Guards, Watchmen, and other security personnel.',
                'icon_class' => 'icon-16',
            ],
            [
                'name' => 'Manufacturing',
                'description' => 'Production Operators, Factory Labour, and related manufacturing roles.',
                'icon_class' => 'icon-11',
            ],
        ];

        foreach ($categories as $category) {
             $fileName = strtolower(str_replace(' ', '-', $category['name'])) . '.jpg';
            JobCategory::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name'        => $category['name'],
                    'description' => $category['description'],
                    'slug'        => Str::slug($category['name']),
                    'image'       => null, // optional default image
                    'icon_class'  => $category['icon_class'],
                ]
            );
        }
    }
}
