<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ["name" => "user1", "email" => "user1@gmail.com", "password" => bcrypt("password")],
            ["name" => "user2", "email" => "user2@gmail.com", "password" => bcrypt("password")],
            ["name" => "user3", "email" => "user3@gmail.com", "password" => bcrypt("password")],
            ["name" => "user4", "email" => "user4@gmail.com", "password" => bcrypt("password")],
            ["name" => "user5", "email" => "user5@gmail.com", "password" => bcrypt("password")]
        ];

        foreach ($users as $user) {
            \App\User::create($user);
        }

    }
}
