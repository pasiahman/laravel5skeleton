<?php

use Illuminate\Database\Seeder;
use Modules\Pages\Models\Pages;
use Modules\Postmetas\Models\Postmetas;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            [
                'post' => [
                    'author_id' => 1,
                    'en' => ['title' => 'Home Popup', 'content' => 'Home Poup Content'],
                    'id' => ['title' => 'Home Popup', 'content' => 'Home Poup Konten']
                ],
                'postmetas' => ['template' => 'default'],
            ],
        ];
        
        foreach ($contents as $content) {
            $post = Pages::create($content['post']);
            (new Postmetas)->sync($content['postmetas'], $post->id);
        }
    }
}
