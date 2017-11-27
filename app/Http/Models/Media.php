<?php

namespace App\Http\Models;

use App\Http\Models\Posts;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class Media extends Posts
{
    protected $attributes = [
        'type' => 'attachment',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author', 'title', 'name', 'content', 'type', 'mime_type', 'status', 'comment_status', 'comment_count',
    ];

    protected $guarded = ['attached_file', 'attached_file_thumbnail'];

    public $mimeTypeImages = ['image/gif', 'image/jpeg', 'image/jpg', 'image/png'];

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

    public function postmetas()
    {
        return $this->hasMany('App\Http\Models\Postmeta', 'post_id', 'id');
    }

    public function setAttachedFile($attachedFile)
    {
        $mimeType = Storage::mimeType($attachedFile);

        if (in_array($mimeType, $this->mimeTypeImages)) {
            $image = Image::make($attachedFile)->trim();

            $max = max($image->height(), $image->width());
            $image->resizeCanvas($max, $max)->resize(Config::get('image.large_size'), Config::get('image.large_size'));

            if (Config::get('image.watermark')) {
                $watermark = Image::make(Config::get('image.watermark_image'));
                $image->insert($watermark, 'center');
            }

            $image->save($attachedFile);
        }
    }

    public function setAttachedFileThumbnail($attachedFile, $attachedFileThumbnail)
    {
        $mimeType = Storage::mimeType($attachedFile);

        if (in_array($mimeType, $this->mimeTypeImages)) {
            Storage::copy($attachedFile, $attachedFileThumbnail);
            $image = Image::make($attachedFile)->resize(Config::get('image.thumbnail_size'), Config::get('image.thumbnail_size'));

            if (Config::get('image.watermark')) {
                $watermark = Image::make(Config::get('image.watermark_image_thumbnail'));
                $image->insert($watermark, 'center');
            }

            $image->save($attachedFileThumbnail);
        } else {
            $attachedFileThumbnail = 'images/media/text.png';
        }

        return $attachedFileThumbnail;
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
