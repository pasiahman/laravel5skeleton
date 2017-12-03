<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Permission;
use App\Http\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        $request->query('sort') ?: $request->query->set('sort', 'name,ASC');
        $request->query('limit') ?: $request->query->set('limit', 10);

        $data['request'] = $request;
        $data['roles'] = Role::search($request->query())->paginate($request->query('limit'));

        if ($request->query('action')) { (new Role)->action($request->query()); return redirect()->back(); }

        return view('backend/roles/index', $data);
    }

    public function create(Request $request)
    {
        $data['permissions'] = Permission::orderBy('name')->get();
        $data['role'] = $role = new Role;

        if ($request->input('create')) {
            $validator = $role->validate($request->input(), 'create');
            if ($validator->passes()) {
                $role->fill($request->input())->save();
                $role->syncPermissions($request->input('permissions'));
                flash(__('cms.data_has_been_created'))->success()->important();
                return redirect()->route('backendRoles');
            } else {
                $message = implode('<br />', $validator->errors()->all()); flash($message)->error()->important();
                $data['errors'] = $validator->errors();
            }
        }

        return view('backend/roles/create', $data);
    }

    public function delete($id)
    {
        $role = Role::search(['id' => $id])->firstOrFail();

        $role->syncPermissions()->delete($id);
        flash(__('cms.data_has_been_deleted'))->success()->important();
        return back();
    }

    public function update(Request $request)
    {
        $role = Role::search(['id' => $request->input('id')])->firstOrFail();

        $data['permissions'] = Permission::orderBy('name')->get();
        $data['role'] = $role;

        if ($request->input('update')) {
            $validator = $role->validate($request->input(), 'update');
            if ($validator->passes()) {
                $role->fill($request->input())->save();
                $role->syncPermissions($request->input('permissions'));
                flash(__('cms.data_has_been_updated'))->success()->important();
                return redirect()->route('backendRoles');
            } else {
                $message = implode('<br />', $validator->errors()->all()); flash($message)->error()->important();
                $data['errors'] = $validator->errors();
            }
        }

        return view('backend/roles/update', $data);
    }
}
