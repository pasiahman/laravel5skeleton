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

        static::addGlobalScope('type', function (Builder $builder) { $builder->where('type', 'attachment'); });
        static::addGlobalScope('status_deleted', function (Builder $builder) { if (! Auth::user()->can('backend media trash')) { $builder->where('status', '<>', 'trash'); } });
    }

    public function getMimeTypeOptionsAttribute()
    {
        return self::orderBy('mime_type')->pluck('mime_type', 'mime_type')->toArray();
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

    public function scopeSearch($query, $params)
    {
        $query = parent::scopeSearch($query, $params);

        if (Auth::user()->can('backend media all')) {
            // all
        } else if (Auth::user()->can('backend media role')) {
            $roles = Auth::user()->getRoleNames();
            $authors = Users::role($roles)->get()->pluck('id', 'id');
            $query->whereIn('author', $authors); // group
        } else if (Auth::user()->can('backend media')) {
            $query->where('author', Auth::user()->id);  // self
        }

        return $query;
    }
}
