<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SectionCategory;
use App\Models\SectionContent;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        // Create the category
        $category = SectionCategory::updateOrCreate(
            ['slug' => 'license-and-certificates'],
            [
                'title' => 'License and Certificates',
                'status' => 'Active',
                'sub_heading' => 'Official licenses and certificates',
                'description' => 'Official licenses and certificates issued by authorized authorities.',
                'description2' => 'These documents validate our legal operations and compliance.',
                'image' => null,
                'video' => null,
            ]
        );

        // Section content titles
        $contents = [
            'Company-Registration',
            'Authorized Certificate From Government',
            'License',
            'Pan-Certificate',
            'Authorized Certificate From Japan',
            'Rba Participation',
        ];

        foreach ($contents as $index => $title) {
            SectionContent::updateOrCreate(
                ['title' => $title, 'section_category_id' => $category->id],
                [
                    'section_category_id' => $category->id,
                    'status' => 'Active',
                    'short_description' => null,
                    'image' => "images/sections/" . strtolower(str_replace(' ', '-', $title)) . ".jpg", // you can adjust path
                    'video' => null,
                    'pdf' => null,
                    'order' => $index + 1,
                    'description' => null,
                    'description2' => null,
                    'icon_class' => null,
                    'link_title' => null,
                    'link_url' => null,
                ]
            );
        }
    }
}
