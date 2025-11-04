<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Logistics',
                'short_desc' => 'Transport and vehicle operation services.',
                'description' => 'Drivers, Trailer, Crane Operators, Excavator Operators, Mechanics (Diesel & Petrol).',
                'status' => 1,
            ],
            [
                'name' => 'Construction Engineer',
                'short_desc' => 'Engineering and construction project roles.',
                'description' => 'Engineers, Surveyor, Quantity Surveyor, Safety Officers, Supervisors, Foreman, Electricians, Masons, Carpenters, Helpers, and more.',
                'status' => 1,
            ],
            [
                'name' => 'Hospitality',
                'short_desc' => 'Service industry and hotel management roles.',
                'description' => 'Managers, Accountants, Secretaries, Waiters, Cooks, Cashiers, Housekeepers, Marketing Executives, and more.',
                'status' => 1,
            ],
            [
                'name' => 'Technician',
                'short_desc' => 'Skilled technical and mechanical roles.',
                'description' => 'Plant Technician, Chiller Plant Technician, A/C Technician, Materials & Concrete Technician, Duct Technician.',
                'status' => 1,
            ],
            [
                'name' => 'Security Guards',
                'short_desc' => 'Security and surveillance services.',
                'description' => 'Security Officers, Supervisors, Guards, Watchmen, and other security personnel.',
                'status' => 1,
            ],
            [
                'name' => 'Manufacturing',
                'short_desc' => 'Production and factory-related work.',
                'description' => 'Production Operators, Factory Labour, and related manufacturing roles.',
                'status' => 1,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['name' => $service['name']], // Ensures no duplicate name
                [
                    'short_desc' => $service['short_desc'],
                    'description' => $service['description'],
                    'status' => $service['status'],
                ]
            );
        }
    }
}
