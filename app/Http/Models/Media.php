<?php

namespace App\Http\Models;

use App\Http\Models\Posts;
use App\Http\Models\Users;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
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
            if (! Auth::user()->can('backend posts deleted')) { $builder->where('status', '<>', 'deleted'); }
        });
    }

    public function validate($input, $scenario)
    {
        if ($scenario == 'update') {
            $rules = [
                'title' => ['required'],
            ];
        }

        return Validator::make($input, $rules);
    }

    public function getMimeTypeOptionsAttribute()
    {
        return self::orderBy('mime_type')->pluck('mime_type', 'mime_type')->toArray();
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
            Storage::exists($attachedFileThumbnail) ? Storage::delete($attachedFileThumbnail) : '';
            Storage::copy($attachedFile, $attachedFileThumbnail);

            $image = Image::make($attachedFile);

            $image->resize(Config::get('image.thumbnail_size'), Config::get('image.thumbnail_size'));

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
        if (Auth::user()->can('backend media all')) {
            // all
        } else if (Auth::user()->can('backend media role')) {
            $roles = Auth::user()->getRoleNames();
            $authors = Users::role($roles)->get()->pluck('id', 'id');
            $query->whereIn('author', $authors); // group
        } else if (Auth::user()->can('backend media')) {
            $query->where('author', Auth::user()->id);  // self
        }
        isset($params['title']) ? $query->where('title', 'like', '%'.$params['title'].'%') : '';
        isset($params['mime_type']) ? $query->where('mime_type', 'like', '%'.$params['mime_type'].'%') : '';
        isset($params['status']) ? $query->where('status', $params['status']) : '';
        isset($params['created_at']) ? $query->where('created_at', 'like', '%'.$params['created_at'].'%') : '';
        isset($params['created_at_date']) ? $query->whereDate('created_at', '=', $params['created_at_date']) : '';
        if (isset($params['sort']) && $sort = explode(',', $params['sort'])) {
            count($sort) == 2 ? $query->orderBy($sort[0], $sort[1]) : '';
        }

        return $query;
    }
}
