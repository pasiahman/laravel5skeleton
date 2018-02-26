<?php

namespace App\Http\Models;

use App\Http\Models\Terms;
use Illuminate\Database\Eloquent\Builder;

class Menus extends Terms
{
    protected $attributes = ['taxonomy' => 'menu'];

    public $post;
    public $title;
    public $url;

    protected static function boot()
    {
        parent::boot();

        $table = (new Terms)->getTable();
        static::addGlobalScope('taxonomy', function (Builder $builder) use ($table) { $builder->where($table.'.taxonomy', 'menu'); });
    }

    public function generateAsHtml($nestable, $template = 'backend_menu_form')
    {
        switch ($template) {
            default :
                $html = $this->generateAsHtmlBackendMenuForm($nestable);
        }

        return $html;
    }

    public function generateAsHtmlBackendMenuForm($nestable)
    {
        $html = '';

        foreach ($nestable as $item) {
            $this->attributes = $item;
            $this->getPost();

            $data['data_id'] = $this->id;
            $data['data_title'] = $this->title;
            $data['data_type'] = $this->type;
            $data['data_url'] = $this->url;
            $data['item'] = $item;
            $data['menu'] = $this;
            $html .= \Illuminate\Support\Facades\View::make('backend/menus/_nestable_template', $data)->render();
        }

        return $html;
    }

    public function getPost()
    {
        switch ($this->type) {
            case 'category' :
                $category = \App\Http\Models\Categories::findOrFail($this->id);
                $this->post = $category;
                $this->title = $category->name;
                $this->url = url('categories/'.$category->slug);
                break;
            case 'post' :
                $post = \App\Http\Models\Posts::findOrFail($this->id);
                $this->post = $post;
                $this->title = $post->title;
                $this->url = url('categories/'.$post->name);
                break;
            default :
                $this->title = '';
                $this->url = '';
        }

        return $this->post;
    }
}
