<?php

namespace Database\Seeders;

use App\Models\Township;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TownshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $townships = [
            [
                'name' => 'Bogale Township (ဘိုကလေးမြို့နယ်)',
                'state_id' => 1,
            ],
            [
                'name' => 'Danubyu Township (ဓနုဖြူမြို့နယ်)',
                'state_id' => 1,
            ],
            [
                'name' => 'Dedaye Township (ဒေးဒရဲမြို့နယ်)',
                'state_id' => 1,
            ],
            [
                'name' => 'Bago Township (ပဲခူးမြို့နယ်)',
                'state_id' => 2,
            ],
            [
                'name' => 'Daik-U Township (ဒိုက်ဦးမြို့နယ်)',
                'state_id' => 2,
            ],
            [
                'name' => 'Kawa Township (ကဝမြို့နယ်)',
                'state_id' => 2,
            ],
            [
                'name' => 'Falam Township (ဖလမ်းမြို့နယ်)',
                'state_id' => 3,
            ],
            [
                'name' => 'Hakha Township (ဟားခါးမြို့နယ်)',
                'state_id' => 3,
            ],
            [
                'name' => 'Kanpetlet Township (ကန်ပက်လက်မြို့နယ်)',
                'state_id' => 3,
            ],
            [
                'name' => 'Bhamo Township (ဗန်းမော်မြို့နယ်)',
                'state_id' => 4,
            ],
            [
                'name' => 'Chipwi Township (ချီဖွေမြို့နယ်)',
                'state_id' => 4,
            ],
            [
                'name' => 'Hpakan Township (ဖားကန့်မြို့နယ်)',
                'state_id' => 4,
            ],
            [
                'name' => 'Bawlakhe Township (ဘောလခဲမြို့နယ်)',
                'state_id' => 5,
            ],
            [
                'name' => 'Demoso Township (ဒီမောဆိုး‌မြို့နယ်)',
                'state_id' => 5,
            ],
            [
                'name' => 'Hpasawng Township (ဖားဆောင်းမြို့နယ်)',
                'state_id' => 5,
            ],
            [
                'name' => 'Hlaingbwe Township (လူၢ်ပျဲၢ်ကီၢ်ဆၣ် - ပါ်စံင်ကၞင့် - လှိုင်းဘွဲ့မြို့နယ်)',
                'state_id' => 6,
            ],
            [
                'name' => 'Hpa-an Township (ဖၣ်အၣ်ကီၢ်ဆၣ် - ထ်ုအင်ကၞင့် - ဘားအံမြို့နယ်)',
                'state_id' => 6,
            ],
            [
                'name' => 'Hpapun Township (ဖာပံင်ကၞင့် - ဖးဖူကီၢ်ဆၣ်- ဖာပွန်မြို့နယ်)',
                'state_id' => 6,
            ],
            [
                'name' => 'Amarapura Township (အမရပူရမြို့နယ်)',
                'state_id' => 7,
            ],
            [
                'name' => 'Aungmyaythazan Township (အောင်မြေသာစံမြို့နယ်)',
                'state_id' => 7,
            ],
            [
                'name' => 'Chanayethazan Township (ချမ်းအေးသာစံမြို့နယ်)',
                'state_id' => 7,
            ],
            [
                'name' => 'Aunglan Township (အောင်လံမြို့နယ်)',
                'state_id' => 8,
            ],
            [
                'name' => 'Chauk Township (ချောက်မြို့နယ်)',
                'state_id' => 8,
            ],
            [
                'name' => 'Gangaw Township (ဂန့်ဂေါမြို့နယ်)',
                'state_id' => 8,
            ],
            [
                'name' => 'Bilin Township (ဘီးလင်းမြို့နယ်)',
                'state_id' => 9,
            ],
            [
                'name' => 'Chaungzon Township (ချောင်းဆုံမြို့နယ်)',
                'state_id' => 9,
            ],
            [
                'name' => 'Kyaikmaraw Township (ကျိုက်မရောမြို့နယ်)',
                'state_id' => 9,
            ],
            [
                'name' => 'Dekkhina Thiri Township (ဒက္ခိဏသီရိမြို့နယ်)',
                'state_id' => 10,
            ],
            [
                'name' => 'Lewe Township (လယ်ဝေးမြို့နယ်)',
                'state_id' => 10,
            ],
            [
                'name' => 'Oattara Thiri Township (ဥတ္တရသီရိမြို့နယ်)',
                'state_id' => 10,
            ],
            [
                'name' => 'Ann Township (အမ်းမြို့နယ်)',
                'state_id' => 11,
            ],
            [
                'name' => 'Buthidaung Township (ဘူးသီးတောင်မြို့နယ်)',
                'state_id' => 11,
            ],
            [
                'name' => 'Gwa Township (ဂွမြို့နယ်)',
                'state_id' => 11,
            ],
            [
                'name' => 'Ayadaw Township (အရာတော်မြို့နယ်)',
                'state_id' => 12,
            ],
            [
                'name' => 'Banmauk Township (ဗန်းမောက်မြို့နယ်)',
                'state_id' => 12,
            ],
            [
                'name' => 'Budalin Township (ဘုတလင်မြို့နယ်)',
                'state_id' => 12,
            ],
            [
                'name' => 'Hopang Township (ဟိုပန်မြို့နယ်)',
                'state_id' => 13,
            ],
            [
                'name' => 'Hopong Township (ဟိုပုံးမြို့နယ်)',
                'state_id' => 13,
            ],
            [
                'name' => 'Hsenwi Township (သိန္နီမြို့နယ်)',
                'state_id' => 13,
            ],
            [
                'name' => 'Bokpyin Township (ဘုတ်ပြင်းမြို့နယ်)',
                'state_id' => 14,
            ],
            [
                'name' => 'Dawei Township (ထားဝယ်မြို့နယ်)',
                'state_id' => 14,
            ],
            [
                'name' => 'Kawthaung Township (ကော့သောင်းမြို့နယ်)',
                'state_id' => 14,
            ],
            [
                'name' => 'Ahlon Township (အလုံမြို့နယ်)',
                'state_id' => 15,
            ],
            [
                'name' => 'Bahan Township (ဗဟန်းမြို့နယ်)',
                'state_id' => 15,
            ],
            [
                'name' => 'Botataung Township (ဗိုလ်တထောင်မြို့နယ်)',
                'state_id' => 15,
            ],
            [
                'name' => 'Cocokyun Township (ကိုကိုးကျွန်းမြို့နယ်)',
                'state_id' => 15,
            ],
            [
                'name' => 'Dagon Seikkan Township (ဒဂုံဆိပ်ကမ်းမြို့နယ်)',
                'state_id' => 15,
            ],
            [
                'name' => 'Dagon Township (ဒဂုံမြို့နယ်)',
                'state_id' => 15,
            ],
        ];

        foreach ($townships as $township) {
            Township::create($township);
        }
    }
}
