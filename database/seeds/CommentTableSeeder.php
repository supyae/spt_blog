<?php

use App\Blog;
use App\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentTableSeeder extends Seeder
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
        $blogs = (new \App\Blog())->pluck('id')->toArray();


        for ($i = 1; $i <= 20; $i++) {
            $comments = (new \App\Comment())->pluck('id')->toArray();
            $blog_id = $blogs[array_rand($blogs)];
            $data = [
                'blog_id'    => $blog_id,
                'user_id'    => $users[array_rand($users)],
                'message'    => $faker->text,
                'created_at' => $faker->dateTime
            ];
//            if (sizeof($comments) > 0) {
//                $parent_id = $comments[array_rand($comments)];
//                if ($parent_id < $i) {
//                    $data['parent_id'] = $parent_id;}
//
//            }

            $comment = new Comment($data);
            $blog = Blog::find($blog_id);
            $blog->comment()->save($comment);

        }
    }
}
