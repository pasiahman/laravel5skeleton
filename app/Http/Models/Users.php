<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Traits\HasRoles;

class Users extends \App\User
{
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $guard_name = 'web';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function validate($input, $scenario = 'create')
    {
        $rules = [
            'id' => ['required', 'integer', 'digits_between:1,10'],
            'name' => ['required', 'digits_between:0,191'],
            'email' => ['required', 'email', 'digits_between:0,191'],
            'password' => ['required', 'digits_between:0,191'],
        ];

        if ($scenario == 'create') {
            $rules = [
                'name' => ['required'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required'],
            ];
        } else if ($scenario == 'update') {
            $rules = [
                'id' => ['required', 'integer', 'digits_between:1,10'],
                'name' => ['required'],
                'email' => ['required', 'email', 'unique:users,email,'.$this->id],
            ];
        }

        return Validator::make($input, $rules);
    }

    public function scopeSearch($query, $params)
    {
        isset($params['name']) ? $query->where('name', 'like', '%'.$params['name'].'%') : '';
        isset($params['email']) ? $query->where('email', 'like', '%'.$params['email'].'%') : '';
        if (isset($params['sort']) && $sort = explode(',', $params['sort'])) {
            count($sort) == 2 ? $query->orderBy($sort[0], $sort[1]) : '';
        }

        return $query;
    }

    public function syncRoles(...$roles)
    {
        $this->roles()->detach();
        if ($roles = array_filter($roles)) {
            return $this->assignRole($roles);
        }
        return $this;
    }
}
