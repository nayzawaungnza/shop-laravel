<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
                'name' => 'Myanmar',
                'iso_code' => 'MM',
            ],
            [
                'name' => 'Singapore',
                'iso_code' => 'SG',
            ],
            // Add more state records as needed
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
