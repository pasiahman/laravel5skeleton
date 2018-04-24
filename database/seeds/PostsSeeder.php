<?php

use Illuminate\Database\Seeder;
use Modules\Postmetas\Models\Postmetas;
use Modules\Posts\Models\Posts;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $limit = 50;

        for ($i = 0; $i < $limit; $i++) {
            $post = Posts::create([
                'author_id' => 1,
                'en' => ['title' => $faker->sentence, 'excerpt' => $faker->text, 'content' => $faker->text(1000)],
                'id' => ['title' => $faker->sentence, 'excerpt' => $faker->text, 'content' => $faker->text(1000)],
            ]);
            (new Postmetas)->sync([
                'template' => 'default',
            ], $post->id);
        }
    }
}
