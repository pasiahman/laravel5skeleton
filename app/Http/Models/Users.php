<?php

namespace App\Http\Models;

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
        'name', 'email', 'phone_number', 'password', 'verification_code',
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

    public function scopeAction($query, $params)
    {
        if ($params['action'] == 'delete' && isset($params['action_id'])) {
            $this->search(['id_in' => $params['action_id']])->delete();
            flash(__('cms.data_has_been_deleted'))->success()->important();
        }
        return $query;
    }

    public function scopeSearch($query, $params)
    {
        isset($params['id']) ? $query->where('id', $params['id']) : '';
        isset($params['id_in']) ? $query->whereIn('id', $params['id_in']) : '';
        isset($params['name']) ? $query->where('name', 'like', '%'.$params['name'].'%') : '';
        isset($params['email']) ? $query->where('email', 'like', '%'.$params['email'].'%') : '';
        isset($params['role_id']) ? $query->whereHas('roles', function ($query) use ($params) { $query->where('id', $params['role_id']); }) : '';
        isset($params['role_name']) ? $query->whereHas('roles', function ($query) use ($params) { $query->where('name', $params['role_name']); }) : '';
        if (isset($params['sort']) && $sort = explode(',', $params['sort'])) {
            if (count($sort) == 2) {
                $query->orderBy($sort[0], $sort[1]);
            }
        }

        return $query;
    }

    public function syncPermissions(...$permissions)
    {
        $this->permissions()->detach();
        if ($permissions = array_filter($permissions)) {
            return $this->givePermissionTo($permissions);
        }
        return $this;
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
