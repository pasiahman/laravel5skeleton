<?php

namespace App\Http\Models;

use App\Http\Models\Terms;
use Illuminate\Database\Eloquent\Builder;

class Tags extends Terms
{
    protected $attributes = ['taxonomy' => 'tag'];

    protected static function boot()
    {
        parent::boot();

        $table = (new Terms)->getTable();
        static::addGlobalScope('taxonomy', function (Builder $builder) use ($table) { $builder->where($table.'.taxonomy', 'tag'); });
    }

    public function getTagIdOptions()
    {
        $options = self::search(['sort' => 'name,ASC'])->get()->pluck('name', 'id')->toArray();
        return $options;
    }
}
