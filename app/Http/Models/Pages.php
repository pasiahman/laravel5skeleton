<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Modules\Posts\Models\Posts;

class Pages extends Posts
{
    protected $attributes = [
        'type' => 'page',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) { $builder->where('type', 'page'); });
        static::addGlobalScope('status_deleted', function (Builder $builder) { Auth::check() && Auth::user()->can('backend pages trash') ?: $builder->where('status', '<>', 'trash'); });
    }
}
