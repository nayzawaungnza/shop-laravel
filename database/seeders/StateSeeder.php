<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            [
                'name' => 'Ayeyarwady Region (ဧရာဝတီတိုင်းဒေသကြီး)',
                'country_id' => 1,
            ],
            [
                'name' => 'Bago Region (ပဲခူးတိုင်းဒေသကြီး)',
                'country_id' => 1,
            ],
            [
                'name' => 'Chin State (ချင်းပြည်နယ်)',
                'country_id' => 1,
            ],
            [
                'name' => 'Kachin (ကချင်ပြည်နယ်)',
                'country_id' => 1,
            ],
            [
                'name' => 'Kayah State (ကယားပြည်နယ်)',
                'country_id' => 1,
            ],
            [
                'name' => 'Kayin State (ကရင်ပြည်နယ်)',
                'country_id' => 1,
            ],
            [
                'name' => 'Mandalay Region (မန္တလေးတိုင်းဒေသကြီး)',
                'country_id' => 1,
            ],
            [
                'name' => 'Magway Region (မကွေးတိုင်းဒေသကြီး)',
                'country_id' => 1,
            ],
            [
                'name' => 'Mon State (မွန်ပြည်နယ်)',
                'country_id' => 1,
            ],
            [
                'name' => 'Naypyitaw (နေပြည်တော်)',
                'country_id' => 1,
            ],
            [
                'name' => 'Rakhine (ရခိုင်ပြည်နယ်)',
                'country_id' => 1,
            ],
            [
                'name' => 'Sagaing Region (စစ်ကိုင်းတိုင်းဒေသကြီး)',
                'country_id' => 1,
            ],
            [
                'name' => 'Shan (ရှမ်းပြည်နယ်)',
                'country_id' => 1,
            ],
            [
                'name' => 'Tanintharyi Region (တနင်္သာရီတိုင်းဒေသကြီး)',
                'country_id' => 1,
            ],
            [
                'name' => 'Yangon Region (ရန်ကုန်တိုင်းဒေသကြီး)',
                'country_id' => 1,
            ],
            // Add more state records as needed
        ];

        foreach ($states as $state) {
            State::create($state);
        }
    }
}
