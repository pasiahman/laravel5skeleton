<?php

use App\Http\Models\CustomLinks;
use App\Http\Models\Postmetas;
use Illuminate\Database\Seeder;

class CustomLinksSeeder extends Seeder
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
                'post' => ['author_id' => 1, 'en' => ['title' => 'Main'], 'id' => ['title' => 'Main']],
                'postmetas' => ['template' => 'default'],
            ],
            [
                'post' => ['author_id' => 1, 'en' => ['title' => 'Dashboard'], 'id' => ['title' => 'Dashboard']],
                'postmetas' => ['template' => 'default'],
            ],
            [
                'post' => ['author_id' => 1, 'en' => ['title' => 'Posts'], 'id' => ['title' => 'Posting']],
                'postmetas' => ['template' => 'default'],
            ],
            [
                'post' => ['author_id' => 1, 'en' => ['title' => 'Categories'], 'id' => ['title' => 'Kategori']],
                'postmetas' => ['template' => 'default'],
            ],
            [
                'post' => ['author_id' => 1, 'en' => ['title' => 'Tags'], 'id' => ['title' => 'Tag']],
                'postmetas' => ['template' => 'default'],
            ],
            [
                'post' => ['author_id' => 1, 'en' => ['title' => 'Custom Links'], 'id' => ['title' => 'Tautan Khusus']],
                'postmetas' => ['template' => 'default'],
            ],
            [
                'post' => ['author_id' => 1, 'en' => ['title' => 'Media'], 'id' => ['title' => 'Media']],
                'postmetas' => ['template' => 'default'],
            ],
            [
                'post' => ['author_id' => 1, 'en' => ['title' => 'Pages'], 'id' => ['title' => 'Halaman']],
                'postmetas' => ['template' => 'default'],
            ],
            [
                'post' => ['author_id' => 1, 'en' => ['title' => 'Medium Categories'], 'id' => ['title' => 'Kategori Media']],
                'postmetas' => ['template' => 'default'],
            ],
            [
                'post' => ['author_id' => 1, 'en' => ['title' => 'Masters'], 'id' => ['title' => 'Pemilik']],
                'postmetas' => ['template' => 'default'],
            ],
            [
                'post' => ['author_id' => 1, 'en' => ['title' => 'Permissions'], 'id' => ['title' => 'Izin']],
                'postmetas' => ['template' => 'default'],
            ],
            [
                'post' => ['author_id' => 1, 'en' => ['title' => 'Roles'], 'id' => ['title' => 'Peran']],
                'postmetas' => ['template' => 'default'],
            ],
            [
                'post' => ['author_id' => 1, 'en' => ['title' => 'Users'], 'id' => ['title' => 'Pengguna']],
                'postmetas' => ['template' => 'default'],
            ],
            [
                'post' => ['author_id' => 1, 'en' => ['title' => 'Menus'], 'id' => ['title' => 'Menu']],
                'postmetas' => ['template' => 'default'],
            ],
            [
                'post' => ['author_id' => 1, 'en' => ['title' => 'Options'], 'id' => ['title' => 'Pilihan']],
                'postmetas' => ['template' => 'default'],
            ],
        ];

        foreach ($contents as $content) {
            $post = CustomLinks::create($content['post']);
            (new Postmetas)->sync($content['postmetas'], $post->id);
        }
    }
}
