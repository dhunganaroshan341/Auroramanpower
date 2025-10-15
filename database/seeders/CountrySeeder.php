<?php

namespace Database\Seeders;

use App\Models\OurCountry;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Helpers\CountryHelper;
use Illuminate\Support\Str;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = CountryHelper::getCountries();

        foreach ($countries as $code => $name) {
            OurCountry::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => $code,
                ]
            );
        }
    }
}
