<?php

use Illuminate\Database\Seeder;
use Modules\Options\Models\Options;
use Modules\Pages\Models\Pages;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            ['type' => 'page_id', 'name' => 'frontend_home_page', 'value' => Pages::search(['name' => 'home'])->firstOrFail()->id],
            ['type' => 'page_id', 'name' => 'frontend_home_popup', 'value' => Pages::search(['name' => 'home-popup'])->firstOrFail()->id],
        ];

        foreach ($contents as $content) {
            $option = Options::firstOrCreate(['type' => $content, 'name' => $content['name']]);
            $option->fill($content)->save();
        }
    }
}
