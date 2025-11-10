<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'adminstar@gmail.com'],
            [
                'full_name' => 'Roshan Dhungana',
                'password' => Hash::make('admin@123#'),
                // 'image' => 'https://via.placeholder.com/150',
                'role' => 'Admin',
                'position' => 'Programmer',
                'email_link' => 'adminstar@gmail.com',
                'facebook_link' => 'https://facebook.com/roshan',
                'instagram_link' => 'https://instagram.com/roshan',
                'twitter_link' => 'https://twitter.com/roshan',
                'phonenumber' => '9823681753',
                'notes' => 'Default admin account for system access.',
                'google_id' => null,
            ]
        );

        // Regular user
        User::updateOrCreate(
            ['email' => 'userstar@gmail.com'],
            [
                'full_name' => 'Regular User',
                'password' => Hash::make('user@123#'),
                // 'image' => 'https://via.placeholder.com/150',
                'role' => 'User',
                'position' => 'Staff',
                'email_link' => 'userstar@gmail.com',
                'facebook_link' => 'https://facebook.com/user',
                'instagram_link' => 'https://instagram.com/user',
                'twitter_link' => 'https://twitter.com/user',
                'phonenumber' => '9800000000',
                'notes' => 'Default regular user account.',
                'google_id' => null,
            ]
        );
    }
}
