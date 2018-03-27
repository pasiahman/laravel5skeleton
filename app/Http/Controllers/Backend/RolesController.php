<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Role;
use App\Http\Requests\Backend\Roles\StoreRequest;
use App\Http\Requests\Backend\Roles\UpdateRequest;
use Illuminate\Http\Request;
use Modules\Permissions\Models\Permission;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        $request->query('sort') ?: $request->query->set('sort', 'name,ASC');
        $request->query('limit') ?: $request->query->set('limit', 10);

        $data['roles'] = Role::search($request->query())->paginate($request->query('limit'));

        if ($request->query('action')) { (new Role)->action($request->query()); return redirect()->back(); }

        return view('backend/roles/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['permissions'] = Permission::orderBy('name')->get();
        $data['role'] = new Role;
        return view('backend/roles/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $role = new Role;
        $role->fill($request->input())->save();
        $role->syncPermissions($request->input('permissions'));
        flash(__('cms.data_has_been_created'))->success()->important();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['permissions'] = Permission::orderBy('name')->get();
        $data['role'] = Role::findOrFail($id);
        return view('backend/roles/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->fill($request->input())->save();
        $role->syncPermissions($request->input('permissions'));
        flash(__('cms.data_has_been_updated'))->success()->important();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);
        $role->syncPermissions()->delete($id);
        flash(__('cms.data_has_been_deleted'))->success()->important();
        return redirect()->back();
    }
}
