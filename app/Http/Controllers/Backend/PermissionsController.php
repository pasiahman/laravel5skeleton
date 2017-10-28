<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PermissionsController extends Controller
{
    public function index(Request $request)
    {
        $request->query('sort') ?: $request->query->set('sort', 'name,ASC');
        $request->query('limit') ?: $request->query->set('limit', 10);

        $data['request'] = $request;
        $data['permissions'] = Permission::search($request->query())->paginate($request->query('limit'));

        return view('backend/permissions/index', $data);
    }

    public function create(Request $request)
    {
        $data['permission'] = $permission = new Permission;

        if ($request->input('create')) {
            $validator = $permission->validate($request->input(), 'create');
            if ($validator->passes()) {
                $permission->fill($request->input())->save();
                flash('Data has been created')->success()->important();
                return redirect()->route('backendPermissions');
            } else {
                $message = implode('<br />', $validator->errors()->all()); flash($message)->error()->important();
                $data['errors'] = $validator->errors();
            }
        }

        return view('backend/permissions/create', $data);
    }

    public function delete($id)
    {
        Permission::find($id)->delete($id);
        flash('Data has been deleted')->success()->important();
        return back();
    }

    public function update(Request $request)
    {
        $data['permission'] = $permission = Permission::find($request->input('id'));

        if ($request->input('update')) {
            $validator = $permission->validate($request->input(), 'update');
            if ($validator->passes()) {
                $permission->fill($request->input())->save();
                flash('Data has been updated')->success()->important();
                return redirect()->route('backendPermissions');
            } else {
                $message = implode('<br />', $validator->errors()->all()); flash($message)->error()->important();
                $data['errors'] = $validator->errors();
            }
        }

        return view('backend/permissions/update', $data);
    }
}
