<?php

namespace App\Http\Models;

use App\Http\Models\Terms;
use Illuminate\Database\Eloquent\Builder;

class Categories extends Terms
{
    protected $attributes = ['taxonomy' => 'category'];

    protected static function boot()
    {
        parent::boot();

        $table = (new Terms)->getTable();
        static::addGlobalScope('taxonomy', function (Builder $builder) use ($table) { $builder->where($table.'.taxonomy', 'category'); });
    }
}
