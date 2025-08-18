<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // Create default admin
        User::updateOrCreate(
            ['email' => 'adminstar@gmail.com'],
            [
                'full_name' => 'Roshan Dhungana',
                'password' => bcrypt('admin@123#'),
                'image' => 'https://via.placeholder.com/150',
                'role' => 'Admin',
                'position' => 'Programmer',
                'email_link' => 'adminstar@gmail.com',
                'facebook_link' => 'https://facebook.com/roshan',
                'instagram_link' => 'https://instagram.com/roshan',
                'twitter_link' => 'https://twitter.com/roshan',
                'phonenumber' => '9823681753',
                'notes' => $faker->paragraph(),
                'google_id' => $faker->uuid(),
            ]
        );

        // Create 5 users using factory
        User::factory()->count(5)->create();
    }
}
