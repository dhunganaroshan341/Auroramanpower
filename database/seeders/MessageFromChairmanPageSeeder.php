<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class MessageFromChairmanPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::updateOrCreate(
            ['slug' => 'message-from-chairman'], // unique identifier
            [
                'title' => 'Message from Chairman',
                'content' => "Aurora Human Resource (p) ltd is extremely happy to introduce our reputation and credibility in the international recruitment field in sourcing Nepalese human resources, and consequently request you to appoint us as your recruitment agent.

We take huge pride in our collaborative approach and experienced techniques in delivering high impact in this field. The results have not only led the company towards success in a short span of time but also earned a strong foundation of client partnership that has turned into long friendships.

We provide qualified, energetic, experienced, hardworking, honest, and sincere Nepali manpower to foreign countries including Malaysia, Japan, Oman, Bahrain, and other government-recognized countries to support deserving candidates to their respective employer destinations with utmost enthusiasm and responsibility. We thank our valued clients for their co-operation and support.

Mr. Rajendra Bhandari
Chairman",
                // 'status' => 1, // active/published
            ]
        );
    }
}
