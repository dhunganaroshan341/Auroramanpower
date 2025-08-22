<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Opportunities for Nepali Workers Abroad: Exploring New Horizons',
                'slug' => Str::slug('Opportunities for Nepali Workers Abroad: Exploring New Horizons'),
                'content' => 'Nepal has a growing workforce eager to explore opportunities abroad. Countries in the Gulf region and Southeast Asia are constantly seeking skilled and semi-skilled labor, offering competitive salaries and better living standards.

For Nepali workers, working abroad not only provides financial stability but also the chance to gain international experience, learn new skills, and contribute to their families back home. Jobs in construction, hospitality, healthcare, and domestic services are among the most in-demand.

Before embarking on a journey abroad, workers should ensure proper documentation, training, and understanding of labor laws in the host country. With proper preparation, migrating for work can be a life-changing opportunity.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Preparing for Work Abroad: Tips for Nepali Migrant Workers',
                'slug' => Str::slug('Preparing for Work Abroad: Tips for Nepali Migrant Workers'),
                'content' => 'Working abroad can be a rewarding experience if approached carefully. Nepali workers planning to move to Gulf countries or other destinations should consider the following:

1. Research the Job and Employer – Verify the company’s credibility and understand your role.
2. Complete Legal Documentation – Ensure your passport, visa, and work permits are valid.
3. Skill Development – Enhance skills relevant to your job, such as technical training or language proficiency.
4. Financial Planning – Budget for travel costs, initial expenses, and savings.
5. Cultural Awareness – Learn about local customs and workplace etiquette to avoid misunderstandings.

With the right preparation, working abroad can be an enriching experience, opening doors to professional growth and financial security.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'The Growing Demand for Skilled Nepali Workers Abroad',
                'slug' => Str::slug('The Growing Demand for Skilled Nepali Workers Abroad'),
                'content' => 'Nepali workers have become highly valued in Gulf and other foreign countries due to their strong work ethic, adaptability, and dedication. Sectors like construction, healthcare, hospitality, and domestic services are experiencing a surge in demand.

For many Nepali families, overseas employment is a major source of income, helping to improve education, healthcare, and overall quality of life. Agencies and manpower companies play a crucial role in connecting workers with reliable employers, guiding them through legal procedures, and ensuring safe and transparent recruitment processes.

By focusing on skill development, professionalism, and adherence to international work standards, Nepali workers can thrive abroad while creating opportunities for future generations.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('posts')->insert($posts);
    }
}
