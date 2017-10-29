<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\Validator;

class Role extends \Spatie\Permission\Models\Role
{
    protected $attributes = [
        'guard_name' => 'web',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'guard_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function validate($input, string $scenario = 'create')
    {
        $rules = [
            'id' => ['required', 'integer', 'digits_between:1,10'],
            'name' => ['required', 'between:0,191'],
            'guard_name' => ['required', 'between:0,191'],
        ];

        if ($scenario == 'create') {
            $rules = [
                'name' => ['required', 'between:0,191', 'unique:roles,name'],
                'guard_name' => ['required', 'between:0,191'],
            ];
        } else if ($scenario == 'update') {
            $rules = [
                'id' => ['required', 'integer', 'digits_between:1,10'],
                'name' => ['required', 'between:0,191', 'unique:roles,name,'.$this->id],
                'guard_name' => ['required', 'between:0,191'],
            ];
        }

        return Validator::make($input, $rules);
    }

    public function getNameOptionsAttribute()
    {
        $options = ['' => ''];
        if ($roles = self::orderBy('name')->get()) {
            $options += $roles->pluck('name', 'id')->toArray();
        }
        return $options;
    }

    public function scopeSearch($query, $params)
    {
        isset($params['name']) ? $query->where('name', 'like', '%'.$params['name'].'%') : '';
        isset($params['guard_name']) ? $query->where('guard_name', 'like', '%'.$params['guard_name'].'%') : '';
        if (isset($params['sort']) && $sort = explode(',', $params['sort'])) {
            count($sort) == 2 ? $query->orderBy($sort[0], $sort[1]) : '';
        }

        return $query;
    }

    public function syncPermissions(...$permissions)
    {
        $this->permissions()->detach();
        if ($permissions = array_filter($permissions)) {
            return $this->givePermissionTo($permissions);
        };
        return $this;
    }
}
