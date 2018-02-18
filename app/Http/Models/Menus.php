<?php

namespace App\Http\Models;

use App\Http\Models\Terms;
use Illuminate\Database\Eloquent\Builder;

class Menus extends Terms
{
    protected $attributes = ['taxonomy' => 'menu'];

    protected static function boot()
    {
        parent::boot();

        $table = (new Terms)->getTable();
        static::addGlobalScope('taxonomy', function (Builder $builder) use ($table) { $builder->where($table.'.taxonomy', 'menu'); });
    }
}
