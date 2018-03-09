<?php

namespace App\Http\Models;

use App\Http\Models\Posts;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

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
