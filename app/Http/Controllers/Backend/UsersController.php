<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Permission;
use App\Http\Models\Role;
use App\Http\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $request->query('sort') ?: $request->query->set('sort', 'email,ASC');
        $request->query('limit') ?: $request->query->set('limit', 10);

        $data['request'] = $request;
        $data['role'] = new Role;
        $data['users'] = Users::with('roles')->search($request->query())->paginate($request->query('limit'));

        return view('backend/users/index', $data);
    }

    public function create(Request $request)
    {
        $data['permissions'] = Permission::orderBy('name')->get();
        $data['roles'] = Role::orderBy('name')->get();
        $data['user'] = $user = new Users;

        if ($request->input('create')) {
            $validator = $user->validate($request->input(), 'create');
            if ($validator->passes()) {
                $request->merge(['password' => Hash::make($request->input('password'))]);
                $user->fill($request->input())->save();
                Auth::user()->can('backend roles') ? $user->syncRoles($request->input('roles')) : '';
                Auth::user()->can('backend permissions') ? $user->syncPermissions($request->input('permissions')) : '';
                flash(__('cms.data_has_been_created'))->success()->important();
                return redirect()->route('backendUsers');
            } else {
                $message = implode('<br />', $validator->errors()->all()); flash($message)->error()->important();
                $data['errors'] = $validator->errors();
            }
        }

        return view('backend/users/create', $data);
    }

    public function delete($id)
    {
        $user = Users::search(['id' => $id])->firstOrFail();

        $user->syncRoles()->delete($id);
        flash(__('cms.data_has_been_deleted'))->success()->important();
        return back();
    }

    public function update(Request $request)
    {
        $user = Users::search(['id' => $request->input('id')])->firstOrFail();

        $data['permissions'] = Permission::orderBy('name')->get();
        $data['roles'] = Role::orderBy('name')->get();
        $data['user'] = $user;

        if ($request->input('update')) {
            $validator = $user->validate($request->input(), 'update');
            if ($validator->passes()) {
                $request->input('password') ? $request->merge(['password' => Hash::make($request->input('password'))]) : $request->request->remove('password');
                $user->fill($request->input())->save();
                Auth::user()->can('backend roles') ? $user->syncRoles($request->input('roles')) : '';
                Auth::user()->can('backend permissions') ? $user->syncPermissions($request->input('permissions')) : '';
                flash(__('cms.data_has_been_updated'))->success()->important();
                return redirect()->route('backendUsers');
            } else {
                $message = implode('<br />', $validator->errors()->all()); flash($message)->error()->important();
                $data['errors'] = $validator->errors();
            }
        }

        return view('backend/users/update', $data);
    }
}
