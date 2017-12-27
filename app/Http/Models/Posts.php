<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Posts extends Model
{
    protected $attributes = [
        'type' => 'post',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author', 'title', 'name', 'excerpt', 'content', 'type', 'mime_type', 'status', 'comment_status', 'comment_count',
    ];

    protected $table = 'posts';

    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($model) {
            $model->postmetas->each(function ($postmeta) { $postmeta->delete(); });
        });

        static::addGlobalScope('type', function (Builder $builder) { $builder->where('type', 'post'); });
        static::addGlobalScope('status_deleted', function (Builder $builder) { if (! Auth::user()->can('backend posts deleted')) { $builder->where('status', '<>', 'deleted'); } });
    }

    public function getStatusOptions()
    {
        $options = [
            'draft' => __('cms.draft'),
            'publish' => __('cms.publish'),
            'trash' => __('cms.trash'),
            'deleted' => __('cms.delete'),
        ];
        return $options;
    }

    public function getStatusOptionsAttribute()
    {
        $statusOptions = $this->getStatusOptions();
        $options = self::pluck('status', 'status')->toArray();
        $options = array_intersect_key($statusOptions, $options);
        return $options;
    }

    public function postmetas()
    {
        return $this->hasMany('App\Http\Models\Postmeta', 'post_id', 'id');
    }

    public function scopeAction($query, $params)
    {
        if (array_key_exists($params['action'], $this->getStatusOptions())) {
            isset($params['action_id']) ? $this->search(['id_in' => $params['action_id']])->update(['status' => $params['action']]) : '';
            flash(__('cms.data_has_been_updated'))->success()->important();
        }
        return $query;
    }

    public function scopeSearch($query, $params)
    {
        isset($params['id']) ? $query->where('id', $params['id']) : '';
        isset($params['id_in']) ? $query->whereIn('id', $params['id_in']) : '';
        isset($params['title']) ? $query->where('title', 'like', '%'.$params['title'].'%') : '';
        isset($params['mime_type']) ? $query->where('mime_type', $params['mime_type']) : '';
        isset($params['mime_type_like']) ? $query->where('mime_type', 'like', '%'.$params['mime_type_like'].'%') : '';
        isset($params['status']) ? $query->where('status', $params['status']) : '';
        isset($params['created_at']) ? $query->where('created_at', 'like', '%'.$params['created_at'].'%') : '';
        isset($params['created_at_date']) ? $query->whereDate('created_at', '=', $params['created_at_date']) : '';
        if (isset($params['sort']) && $sort = explode(',', $params['sort'])) {
            count($sort) == 2 ? $query->orderBy($sort[0], $sort[1]) : '';
        }

        return $query;
    }
}
