<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SectionCategory;
use App\Models\SectionContent;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        // Create a single category: license-and-certificates
        $category = SectionCategory::updateOrCreate(
            ['slug' => 'license-and-certificates'],
            [
                'title' => 'License and Certificates',
                'status' => 'Active',
                'sub_heading' => 'Official licenses and certificates',
                'image' => null, // add image if you want
                'video' => null, // add video if needed
                'description' => 'Official licenses and certificates issued by authorized authorities.',
                'description2' => 'These documents validate our legal operations and compliance.',
            ]
        );

        // Optional: create sample content for this category
        SectionContent::updateOrCreate(
            ['title' => 'Sample License', 'section_category_id' => $category->id],
            [
                'section_category_id' => $category->id,
                'status' => 'Active',
                'short_description' => 'A sample license or certificate',
                'image' => null,
                'video' => null,
                'pdf' => null,
                'order' => 1,
                'description' => 'This is a sample license or certificate content.',
                'description2' => 'Additional details about the license or certificate.',
                'icon_class' => 'fas fa-certificate',
                'link_title' => 'View License',
                'link_url' => '#',
            ]
        );
    }
}
