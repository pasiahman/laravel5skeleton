<?php

use App\Http\Models\CustomLinks;
use App\Http\Models\Menus;
use App\Http\Models\Termmetas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Modules\Permissions\Models\Permission;

class MenusSeeder extends Seeder
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
                'term' => ['en' => ['name' => 'Backend Main'], 'id' => ['name' => 'Backend Main']],
                'termmetas' => [
                    'template' => 'default',
                    'nestable' => json_encode([
                        [
                            'url' => 'backend/dashboard',
                            'type' => 'custom_link',
                            'title' => CustomLinks::search(['name' => 'dashboard'])->firstOrFail()->title,
                            'permission' => Permission::where('name', 'backend dashboard')->firstOrFail()->id,
                            'id' => CustomLinks::search(['name' => 'dashboard'])->firstOrFail()->id,
                            'icon' => 'fa fa-dashboard',
                        ],
                        [
                            'url' => '',
                            'type' => 'custom_link',
                            'title' => CustomLinks::search(['name' => 'posts'])->firstOrFail()->title,
                            'permission' => Permission::where('name', 'backend posts')->firstOrFail()->id,
                            'id' => CustomLinks::search(['name' => 'posts'])->firstOrFail()->id,
                            'icon' => 'fa fa-book',
                            'children' => [
                                [
                                    'url' => 'backend/categories',
                                    'type' => 'custom_link',
                                    'title' => CustomLinks::search(['name' => 'categories'])->firstOrFail()->title,
                                    'permission' => Permission::where('name', 'backend categories')->firstOrFail()->id,
                                    'id' => CustomLinks::search(['name' => 'categories'])->firstOrFail()->id,
                                    'icon' => 'fa fa-circle-o',
                                ],
                                [
                                    'url' => 'backend/tags',
                                    'type' => 'custom_link',
                                    'title' => CustomLinks::search(['name' => 'tags'])->firstOrFail()->title,
                                    'permission' => Permission::where('name', 'backend tags')->firstOrFail()->id,
                                    'id' => CustomLinks::search(['name' => 'tags'])->firstOrFail()->id,
                                    'icon' => 'fa fa-circle-o',
                                ],
                                [
                                    'url' => 'backend/posts',
                                    'type' => 'custom_link',
                                    'title' => CustomLinks::search(['name' => 'posts'])->firstOrFail()->title,
                                    'permission' => Permission::where('name', 'backend posts')->firstOrFail()->id,
                                    'id' => CustomLinks::search(['name' => 'posts'])->firstOrFail()->id,
                                    'icon' => 'fa fa-book',
                                ],
                                [
                                    'url' => 'backend/custom-links',
                                    'type' => 'custom_link',
                                    'title' => CustomLinks::search(['name' => 'custom-links'])->firstOrFail()->title,
                                    'permission' => Permission::where('name', 'backend custom links')->firstOrFail()->id,
                                    'id' => CustomLinks::search(['name' => 'custom-links'])->firstOrFail()->id,
                                    'icon' => 'fa fa-circle-o',
                                ],
                            ],
                        ],
                        [
                            'url' => '',
                            'type' => 'custom_link',
                            'title' => CustomLinks::search(['name' => 'media'])->firstOrFail()->title,
                            'permission' => Permission::where('name', 'backend media')->firstOrFail()->id,
                            'id' => CustomLinks::search(['name' => 'media'])->firstOrFail()->id,
                            'icon' => 'fa fa-upload',
                            'children' => [
                                [
                                    'url' => 'backend/medium-categories',
                                    'type' => 'custom_link',
                                    'title' => CustomLinks::search(['name' => 'medium-categories'])->firstOrFail()->title,
                                    'permission' => Permission::where('name', 'backend medium categories')->firstOrFail()->id,
                                    'id' => CustomLinks::search(['name' => 'medium-categories'])->firstOrFail()->id,
                                    'icon' => 'fa fa-circle-o',
                                ],
                                [
                                    'url' => 'backend/media',
                                    'type' => 'custom_link',
                                    'title' => CustomLinks::search(['name' => 'media'])->firstOrFail()->title,
                                    'permission' => Permission::where('name', 'backend media')->firstOrFail()->id,
                                    'id' => CustomLinks::search(['name' => 'media'])->firstOrFail()->id,
                                    'icon' => 'fa fa-upload',
                                ],
                            ],
                        ],
                        [
                            'url' => 'backend/pages',
                            'type' => 'custom_link',
                            'title' => CustomLinks::search(['name' => 'pages'])->firstOrFail()->title,
                            'permission' => Permission::where('name', 'backend pages')->firstOrFail()->id,
                            'id' => CustomLinks::search(['name' => 'pages'])->firstOrFail()->id,
                            'icon' => 'fa fa-file',
                        ],
                    ]),
                ],
            ],
            [
                'term' => ['en' => ['name' => 'Backend Master'], 'id' => ['name' => 'Backend Master']],
                'termmetas' => [
                    'template' => 'default',
                    'nestable' => json_encode([
                        [
                            'url' => '',
                            'type' => 'custom_link',
                            'title' => CustomLinks::search(['name' => 'masters'])->firstOrFail()->title,
                            'permission' => Permission::where('name', 'backend masters')->firstOrFail()->id,
                            'id' => CustomLinks::search(['name' => 'masters'])->firstOrFail()->id,
                            'icon' => 'fa fa-book',
                            'children' => [
                                [
                                    'url' => 'backend/permissions',
                                    'type' => 'custom_link',
                                    'title' => CustomLinks::search(['name' => 'permissions'])->firstOrFail()->title,
                                    'permission' => Permission::where('name', 'backend permissions')->firstOrFail()->id,
                                    'id' => CustomLinks::search(['name' => 'permissions'])->firstOrFail()->id,
                                    'icon' => 'fa fa-ban',
                                ],
                                [
                                    'url' => 'backend/roles',
                                    'type' => 'custom_link',
                                    'title' => CustomLinks::search(['name' => 'roles'])->firstOrFail()->title,
                                    'permission' => Permission::where('name', 'backend roles')->firstOrFail()->id,
                                    'id' => CustomLinks::search(['name' => 'roles'])->firstOrFail()->id,
                                    'icon' => 'fa fa-user',
                                ],
                                [
                                    'url' => 'backend/users',
                                    'type' => 'custom_link',
                                    'title' => CustomLinks::search(['name' => 'users'])->firstOrFail()->title,
                                    'permission' => Permission::where('name', 'backend users')->firstOrFail()->id,
                                    'id' => CustomLinks::search(['name' => 'users'])->firstOrFail()->id,
                                    'icon' => 'fa fa-users',
                                ],
                                [
                                    'url' => 'backend/menus',
                                    'type' => 'custom_link',
                                    'title' => CustomLinks::search(['name' => 'menus'])->firstOrFail()->title,
                                    'permission' => Permission::where('name', 'backend menus')->firstOrFail()->id,
                                    'id' => CustomLinks::search(['name' => 'menus'])->firstOrFail()->id,
                                    'icon' => 'fa fa-bars',
                                ],
                                [
                                    'url' => 'backend/options',
                                    'type' => 'custom_link',
                                    'title' => CustomLinks::search(['name' => 'options'])->firstOrFail()->title,
                                    'permission' => Permission::where('name', 'backend options')->firstOrFail()->id,
                                    'id' => CustomLinks::search(['name' => 'options'])->firstOrFail()->id,
                                    'icon' => 'fa fa-sliders',
                                ],
                            ],
                        ],
                    ]),
                ],
            ],
            [
                'term' => ['en' => ['name' => 'Frontend Default Top Right'], 'id' => ['name' => 'Frontend Default Top Right']],
                'termmetas' => [],
            ],
            [
                'term' => ['en' => ['name' => 'Frontend Default Top Left'], 'id' => ['name' => 'Frontend Default Top Left']],
                'termmetas' => [],
            ],
        ];

        foreach ($contents as $content) {
            $term = Menus::create($content['term']);
            (new Termmetas)->sync($content['termmetas'], $term->id);
        }
    }
}
