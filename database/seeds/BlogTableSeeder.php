<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('en_GB');
        $faker->addProvider(new Faker\Provider\en_GB\Address($faker));

        $users = (new \App\User())->pluck('id')->toArray();

        for ($i = 1; $i <= 20; $i++) {
            DB::table('blog')->insert([
                'user_id'    => $users[array_rand($users)],
                'title'      => $faker->title,
                'body'       => $faker->paragraph,
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime
            ]);
        }
    }
}
