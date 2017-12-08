<?php

namespace App\Http\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use redzjovi\php\ArrayHelper;

class Terms extends Model
{
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'taxonomy', 'description', 'parent_id', 'count',
    ];

    protected $table = 'terms';

    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($model) {
            $model->Termmetas->each(function ($Termmeta) { $Termmeta->delete(); });
        });
    }

    public function validate($input, $scenario = '')
    {
        $rules = [
            'id' => ['required', 'integer', 'digits_between:1,20'],
            'name' => ['required', 'between:0,200'],
            'slug' => ['required', 'between:0,200'],
            'taxonomy' => ['required', 'between:0,100'],
            'description' => ['required'],
            'parent' => ['required', 'integer', 'digits_between:1,20'],
            'count' => ['required', 'integer', 'digits_between:1,20'],
        ];

        return Validator::make($input, $rules);
    }

    public function getParentOptions()
    {
        // return self::orderBy('name')->get()->pluck('name', 'id')->toArray();
        $parents = self::orderBy('name')->get()->toArray();
        $parents = ArrayHelper::copyKeyName($parents, 'parent_id', 'parent');
        $tree = ArrayHelper::buildTree($parents);
        $tree = ArrayHelper::printTree($tree);
        $options = collect($tree)->pluck('tree_name', 'id')->toArray();
        return $options;
    }

    public function parent()
    {
        return $this->belongsTo('App\Http\Models\Terms', 'parent_id');
    }

    public function scopeAction($query, $params)
    {
        if ($params['action'] == 'delete') {
            isset($params['action_id']) ? $this->search(['id_in' => $params['action_id']])->delete() : '';
            flash(__('cms.data_has_been_updated'))->success()->important();
        }
        return $query;
    }

    public function scopeSearch($query, $params)
    {
        isset($params['id']) ? $query->where('id', $params['id']) : '';
        isset($params['id_in']) ? $query->whereIn('id', $params['id_in']) : '';
        isset($params['name']) ? $query->where('name', 'like', '%'.$params['name'].'%') : '';
        isset($params['slug']) ? $query->where('slug', 'like', '%'.$params['slug'].'%') : '';
        isset($params['description']) ? $query->where('description', 'like', '%'.$params['description'].'%') : '';
        isset($params['parent_id']) ? $query->where('parent_id', $params['parent_id']) : '';
        if (isset($params['count'])) {
            if (isset($params['count_operator'])) {
                $query->where('count', $params['count_operator'], $params['count']);
            } else {
                $query->where('count', $params['count']);
            }
        }
        if (isset($params['sort']) && $sort = explode(',', $params['sort'])) {
            $sort[0] == 'parent.name' ? $query->leftJoin(self::getTable().' AS parent', 'parent.id', '=', self::getTable().'.parent_id')->select([$this->getTable().'.*', 'parent.name AS parent_name']) : '';
            count($sort) == 2 ? $query->orderBy($sort[0], $sort[1]) : '';
        }

        return $query;
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => ['source' => 'name'],
        ];
    }

    public function termmetas()
    {
        return $this->hasMany('App\Http\Models\Termmeta', 'term_id', 'id');
    }
}
