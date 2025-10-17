<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\JobCategory;
use Illuminate\Support\Str;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = JobCategory::all();
        if ($categories->count() === 0) {
            $this->command->warn('⚠️ No categories found. Please run JobCategorySeeder first.');
            return;
        }

        $titles = [
            'Construction Supervisor',
            'Electrical Engineer',
            'Mechanical Technician',
            'Security Guard',
            'Chef de Partie',
            'AC Technician',
            'Project Manager',
            'Waiter / Waitress',
            'Forklift Operator',
            'Crane Operator',
            'Quantity Surveyor',
            'Site Safety Officer',
            'Plant Operator',
            'Housekeeping Staff',
            'Front Desk Receptionist',
            'Factory Worker',
            'Civil Foreman',
            'Excavator Operator',
            'Production Supervisor',
            'Marketing Executive',
        ];

        foreach ($titles as $title) {
            $job = Job::create([
                'custom_company_name' => fake()->company(),
                'vacancy_id'          => null,
                'male_opening'        => rand(1, 10),
                'female_opening'      => rand(1, 10),
                'total_openings'      => rand(2, 20),
                'title'               => $title,
                'description'         => fake()->paragraph(3),
                'requirements'        => fake()->sentence(10),
                'interview_date'      => now()->addDays(rand(5, 25)),
                'location'            => fake()->city(),
                'salary'              => 'NPR ' . rand(15000, 60000),
                'status'              => 'active',
                'job_code'            => strtoupper(Str::random(6)),
                'slug'                => Str::slug($title),
                'image'               => null,
                'pdf'                 => null,
                'link'                => null,
                'icon_class'          => 'fa-solid fa-briefcase',
                'our_country_id'      => rand(1, 72),
            ]);

            // Randomly attach 1–3 categories to each job
            $job->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        }

        $this->command->info('✅ 20 sample jobs created successfully!');
    }
}
