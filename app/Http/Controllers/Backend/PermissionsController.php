<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Permission;
use Illuminate\Http\Request;

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
                flash(__('cms.data_has_been_created'))->success()->important();
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
        $permission = Permission::search(['id' => $id])->firstOrFail();

        $permission->delete();
        flash(__('cms.data_has_been_deleted'))->success()->important();
        return back();
    }

    public function update(Request $request)
    {
        $data['permission'] = $permission = Permission::search(['id' => $request->input('id')])->firstOrFail();

        if ($request->input('update')) {
            $validator = $permission->validate($request->input(), 'update');
            if ($validator->passes()) {
                $permission->fill($request->input())->save();
                flash(__('cms.data_has_been_updated'))->success()->important();
                return redirect()->route('backendPermissions');
            } else {
                $message = implode('<br />', $validator->errors()->all()); flash($message)->error()->important();
                $data['errors'] = $validator->errors();
            }
        }

        return view('backend/permissions/update', $data);
    }
}
