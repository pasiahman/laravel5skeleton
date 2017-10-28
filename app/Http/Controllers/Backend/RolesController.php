<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        $request->query('sort') ?: $request->query->set('sort', 'name,ASC');
        $request->query('limit') ?: $request->query->set('limit', 10);

        $data['request'] = $request;
        $data['roles'] = Role::search($request->query())->paginate($request->query('limit'));

        return view('backend/roles/index', $data);
    }

    public function create(Request $request)
    {
        $data['role'] = $role = new Role;

        if ($request->input('create')) {
            $validator = $role->validate($request->input(), 'create');
            if ($validator->passes()) {
                $role->fill($request->input())->save();
                flash('Data has been created')->success()->important();
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
        $role = Role::find($id) ?: abort(404);

        $role->delete($id);
        flash('Data has been deleted')->success()->important();
        return back();
    }

    public function update(Request $request)
    {
        $role = Role::find($request->input('id')) ?: abort(404);

        $data['role'] = $role;

        if ($request->input('update')) {
            $validator = $role->validate($request->input(), 'update');
            if ($validator->passes()) {
                $role->fill($request->input())->save();
                flash('Data has been updated')->success()->important();
                return redirect()->route('backendRoles');
            } else {
                $message = implode('<br />', $validator->errors()->all()); flash($message)->error()->important();
                $data['errors'] = $validator->errors();
            }
        }

        return view('backend/roles/update', $data);
    }
}
