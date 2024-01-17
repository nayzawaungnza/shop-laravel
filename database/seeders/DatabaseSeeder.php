<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\StateSeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\TownshipSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(CountrySeeder::class);

        $this->call(StateSeeder::class);

        $this->call(TownshipSeeder::class);

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'phone' => '09256530563',
            'gender' => 'male',
            'address' => 'Yangon',
            'role' => 'admin',
            'password' => Hash::make('password'),

        ]);
        User::create([
            'name' => 'Client Admin',
            'email' => 'client@admin.com',
            'phone' => '09256530563',
            'gender' => 'male',
            'address' => 'Yangon',
            'role' => 'admin',
            'password' => Hash::make('password'),

        ]);
        User::create([
            'name' => 'Client Super Admin',
            'email' => 'clientsuper@admin.com',
            'phone' => '09256530563',
            'gender' => 'female',
            'address' => 'Yangon',
            'role' => 'admin',
            'password' => Hash::make('password'),

        ]);
        User::create([
            'name' => 'Client',
            'email' => 'client1@admin.com',
            'phone' => '09256530563',
            'gender' => 'other',
            'address' => 'Yangon',
            'role' => 'admin',
            'password' => Hash::make('password'),

        ]);
        User::create([
            'name' => 'Client2',
            'email' => 'client2@admin.com',
            'phone' => '09256530563',
            'gender' => 'female',
            'address' => 'Yangon',
            'role' => 'admin',
            'password' => Hash::make('password'),

        ]);
        User::create([
            'name' => 'Client 3',
            'email' => 'client3@admin.com',
            'phone' => '09256530563',
            'gender' => 'female',
            'address' => 'Yangon',
            'role' => 'admin',
            'password' => Hash::make('password'),

        ]);
        User::create([
            'name' => 'Client 4',
            'email' => 'client4@admin.com',
            'phone' => '09256530563',
            'gender' => 'other',
            'address' => 'Yangon',
            'role' => 'admin',
            'password' => Hash::make('password'),

        ]);
        User::create([
            'name' => 'Client 5',
            'email' => 'client5@admin.com',
            'phone' => '09256530563',
            'gender' => 'male',
            'address' => 'Yangon',
            'role' => 'admin',
            'password' => Hash::make('password'),

        ]);

        User::create([
            'name' => 'Nay Zaw Aung',
            'email' => 'nayzawaung.nza750@gmail.com',
            'phone' => '09256530564',
            'gender' => 'male',
            'address' => 'Yangon',
            'role' => 'customer',
            'password' => Hash::make('1qaz23$wsx'),

        ]);
        User::create([
            'name' => 'Nay Zaw',
            'email' => 'nayzaw@gmail.com',
            'phone' => '09256530564',
            'gender' => 'other',
            'address' => 'Yangon',
            'role' => 'customer',
            'password' => Hash::make('1qaz23$wsx'),

        ]);
        User::create([
            'name' => 'Nay Aung',
            'email' => 'nayaung@gmail.com',
            'phone' => '09256530564',
            'gender' => 'other',
            'address' => 'Yangon',
            'role' => 'customer',
            'password' => Hash::make('1qaz23$wsx'),

        ]);
        User::create([
            'name' => 'Thu Thu',
            'email' => 'thuthu@gmail.com',
            'phone' => '09256530564',
            'gender' => 'fmale',
            'address' => 'Yangon',
            'role' => 'customer',
            'password' => Hash::make('1qaz23$wsx'),

        ]);
        User::create([
            'name' => 'Aye Aye',
            'email' => 'ayeaye@gmail.com',
            'phone' => '09256530564',
            'gender' => 'female',
            'address' => 'Yangon',
            'role' => 'customer',
            'password' => Hash::make('1qaz23$wsx'),

        ]);
        User::create([
            'name' => 'Tun Tun',
            'email' => 'tuntun@gmail.com',
            'phone' => '09256530564',
            'gender' => 'male',
            'address' => 'Yangon',
            'role' => 'customer',
            'password' => Hash::make('1qaz23$wsx'),

        ]);
        User::create([
            'name' => 'Mg Mg',
            'email' => 'mgmg@gmail.com',
            'phone' => '09256530564',
            'gender' => 'male',
            'address' => 'Yangon',
            'role' => 'customer',
            'password' => Hash::make('1qaz23$wsx'),

        ]);
    }
}
