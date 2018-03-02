<?php

use Illuminate\Database\Seeder;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $limit = 50;

        for ($i = 0; $i < $limit; $i++) {
            $user = \App\Http\Models\Users::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $faker->password
            ]);
            $user->assignRole('member');

            \App\Http\Models\Cnr\UserDetails::create([
                'user_id' => $user->id,
                'phone_number' => $faker->phoneNumber,
                'api_token' => $faker->md5,
                'verification_code' => $faker->numberBetween(0, 9999),
            ]);

            $balance = \App\Http\Models\Cnr\CnrBalances::create([
                'user_id' => $user->id,
                'amount' => $faker->numberBetween(50000, 300000),
            ]);
        }
    }
}
