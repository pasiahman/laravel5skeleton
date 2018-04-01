<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Modules\Posts\Models\Posts;

class CustomLinks extends Posts
{
    protected $attributes = [
        'type' => 'custom_link',
        'status' => 'publish'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) { $builder->where('type', 'custom_link'); });
        static::addGlobalScope('status_deleted', function (Builder $builder) { Auth::check() && Auth::user()->can('backend custom links trash') ?: $builder->where('status', '<>', 'trash'); });
    }
}
