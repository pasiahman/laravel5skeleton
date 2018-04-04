<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@email.com',
                'password' => \Hash::make('superadmin'),
                'access_token' => \Hash::make(time()),
                'verified' => 1,
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'password' => \Hash::make('admin'),
                'access_token' => \Hash::make(time()),
                'verified' => 1,
            ],
        ]);
    }
}
