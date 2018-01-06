<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Permission;
use App\Http\Models\Role;
use App\Http\Models\Users;
use App\Http\Requests\Backend\Users\StoreRequest;
use App\Http\Requests\Backend\Users\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $request->query('sort') ?: $request->query->set('sort', 'email,ASC');
        $request->query('limit') ?: $request->query->set('limit', 10);

        $data['role'] = new Role;
        $data['users'] = Users::with('roles')->search($request->query())->paginate($request->query('limit'));

        if ($request->query('action')) { (new Users)->action($request->query()); return redirect()->back(); }

        return view('backend/users/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['permissions'] = Permission::orderBy('name')->get();
        $data['roles'] = Role::orderBy('name')->get();
        $data['user'] = new Users;
        return view('backend/users/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $request->merge(['password' => Hash::make($request->input('password'))]);

        $user = new Users;
        $user->fill($request->input())->save();
        auth()->user()->can('backend roles') ? $user->syncRoles($request->input('roles')) : '';
        auth()->user()->can('backend permissions') ? $user->syncPermissions($request->input('permissions')) : '';
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
        $data['roles'] = Role::orderBy('name')->get();
        $data['user'] = Users::findOrFail($id);
        return view('backend/users/update', $data);
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
        $user = Users::findOrFail($id);
        $request->input('password') ? $request->merge(['password' => Hash::make($request->input('password'))]) : $request->request->remove('password');
        $user->fill($request->input())->save();
        auth()->user()->can('backend roles') ? $user->syncRoles($request->input('roles')) : '';
        auth()->user()->can('backend permissions') ? $user->syncPermissions($request->input('permissions')) : '';
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
        $user = Users::findOrFail($id);
        $user->syncRoles()->delete($id);
        flash(__('cms.data_has_been_deleted'))->success()->important();
        return redirect()->back();
    }
}
