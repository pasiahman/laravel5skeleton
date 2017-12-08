<?php

namespace App\Http\Models;

use App\Http\Models\Terms;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class Categories extends Terms
{
    protected $attributes = [
        'taxonomy' => 'category',
    ];

    protected static function boot()
    {
        parent::boot();

        $table = (new Terms)->getTable();
        static::addGlobalScope('taxonomy', function (Builder $builder) use ($table) { $builder->where($table.'.taxonomy', 'category'); });
    }

    public function validate($input, $scenario = '')
    {
        if ($scenario == 'create') {
            $rules = [
                'name' => ['required', 'between:0,200'],
                'slug' => ['between:0,200'],
            ];
        } else if ($scenario == 'update') {
            $rules = [
                'id' => ['required', 'integer', 'digits_between:1,20'],
                'name' => ['required', 'between:0,200'],
                'slug' => ['between:0,200'],
            ];
        }

        return Validator::make($input, $rules);
    }
}
