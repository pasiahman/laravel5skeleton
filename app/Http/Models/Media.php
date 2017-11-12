<?php

namespace App\Http\Models;

use App\Http\Models\Posts;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Media extends Posts
{
    protected $attribute = [
        'type' => 'attachment',

        'attached_file_thumbnail' => '',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author', 'title', 'name', 'content', 'type', 'mime_type', 'status', 'comment_status', 'comment_count',
    ];

    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($model) {
            $model->postmetas->each(function ($postmeta) { $postmeta->delete(); });
        });

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'attachment');
        });
    }

    public function getMimeTypeOptionsAttribute()
    {
        $options = ['' => ''];
        $mimeTypes = self::orderBy('mime_type')->pluck('mime_type', 'mime_type')->toArray();
        $mimeTypes ? $options += $mimeTypes : '';
        return $options;
    }

    public function getAttachedFileThumbnailAttribute()
    {
        return $this->attached_file_thumbnail;
    }

    public function postmetas()
    {
        return $this->hasMany('App\Http\Models\Postmeta', 'post_id', 'id');
    }

    public function setAttachedFileThumbnailAttribute($attached_file)
    {
        $url = Storage::disk('media')->url($attached_file);
        // dd($url);

        $this->attached_file_thumbnail = $attached_file;
        return $this;
    }

    public function scopeSearch($query, $params)
    {
        isset($params['title']) ? $query->where('title', 'like', '%'.$params['title'].'%') : '';
        isset($params['mime_type']) ? $query->where('mime_type', 'like', '%'.$params['mime_type'].'%') : '';
        isset($params['created_at']) ? $query->where('created_at', 'like', '%'.$params['created_at'].'%') : '';
        if (isset($params['sort']) && $sort = explode(',', $params['sort'])) {
            count($sort) == 2 ? $query->orderBy($sort[0], $sort[1]) : '';
        }

        return $query;
    }
}
