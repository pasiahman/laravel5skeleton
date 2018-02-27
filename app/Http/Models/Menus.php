<?php

namespace App\Http\Models;

use App\Http\Models\Posts;
use App\Http\Models\Tags;
use App\Http\Models\Terms;
use Illuminate\Database\Eloquent\Builder;

class Menus extends Terms
{
    protected $attributes = [
        'taxonomy' => 'menu',

        // custom attribute
        'post',
        'title',
        'url',
    ];

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

    public function getCategoriesTree()
    {
        $tree = (new Categories)->getTermsTree();
        return $tree;
    }

    public function getCustomLinkIdOptions()
    {
        $tree = (new \App\Http\Models\CustomLinks)->getPostIdOptions();
        return $tree;
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
            case 'custom_link' :
                $customLink = \App\Http\Models\CustomLinks::findOrFail($this->id);
                $this->post = $customLink;
                $this->title = $customLink->title;
                $this->url = $this->url;
                break;
            case 'post' :
                $post = Posts::findOrFail($this->id);
                $this->post = $post;
                $this->title = $post->title;
                $this->url = url('categories/'.$post->name);
                break;
            case 'tag' :
                $tag = Tags::findOrFail($this->id);
                $this->post = $tag;
                $this->title = $tag->name;
                $this->url = url('tags/'.$tag->name);
                break;
            default :
                $this->title = '';
                $this->url = '';
        }

        return $this->post;
    }

    public function getPostIdOptions()
    {
        $options = (new Posts)->getPostIdOptions();
        return $options;
    }

    public function getTagIdOptions()
    {
        $options = (new Tags)->getTagIdOptions();
        return $options;
    }
}
