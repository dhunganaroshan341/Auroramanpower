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
                'icon_class' => 'fa-solid fa-truck',
            ],
            [
                'name' => 'Construction Engineer',
                'description' => 'Engineers, Surveyor, Quantity Surveyor, Safety Officers, Supervisors, Foreman, Electricians, Masons, Carpenters, Helpers, and more.',
                'icon_class' => 'fa-solid fa-hard-hat',
            ],
            [
                'name' => 'Hospitality',
                'description' => 'Managers, Accountants, Secretaries, Waiters, Cooks, Cashiers, Housekeepers, Marketing Executives, and more.',
                'icon_class' => 'fa-solid fa-utensils',
            ],
            [
                'name' => 'Technician',
                'description' => 'Plant Technician, Chiller Plant Technician, A/C Technician, Materials & Concrete Technician, Duct Technician.',
                'icon_class' => 'fa-solid fa-tools',
            ],
            [
                'name' => 'Security Guards',
                'description' => 'Security Officers, Supervisors, Guards, Watchmen, and other security personnel.',
                'icon_class' => 'fa-solid fa-shield-halved',
            ],
            [
                'name' => 'Manufacturing',
                'description' => 'Production Operators, Factory Labour, and related manufacturing roles.',
                'icon_class' => 'fa-solid fa-industry',
            ],
        ];

        foreach ($categories as $category) {
            JobCategory::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name'        => $category['name'],
                    'description' => $category['description'],
                    'slug'        => Str::slug($category['name']),
                    'image'       => null, // set default image if you like e.g. 'default.png'
                    'icon_class'  => $category['icon_class'],
                ]
            );
        }
    }
}
