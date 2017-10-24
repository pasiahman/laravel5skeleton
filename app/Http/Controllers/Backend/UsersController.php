<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $request->query('sort') ?: $request->query->set('sort', 'email,ASC');
        $request->query('limit') ?: $request->query->set('limit', 10);

        $data['request'] = $request;
        $data['users'] = Users::search($request->query())->paginate($request->query('limit'));

        return view('backend/users/index', $data);
    }

    public function create(Request $request)
    {
        $data['user'] = $user = new Users;

        if ($request->input('create')) {
            $validator = $user->validate($request->input(), 'create');
            if ($validator->passes()) {
                $request->merge(['password' => Hash::make($request->input('password'))]);
                $user->fill($request->input())->save();
                flash('Data has been created')->success()->important();
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
        Users::find($id)->delete($id);
        flash('Data has been deleted')->success()->important();
        return back();
    }

    public function update(Request $request)
    {
        $data['user'] = $user = Users::find($request->input('id'));

        if ($request->input('update')) {
            $validator = $user->validate($request->input(), 'update');
            if ($validator->passes()) {
                $request->input('password') ? $request->merge(['password' => Hash::make($request->input('password'))]) : $request->request->remove('password');
                $user->fill($request->input())->save();
                flash('Data has been updated')->success()->important();
                return redirect()->route('backendUsers');
            } else {
                $message = implode('<br />', $validator->errors()->all()); flash($message)->error()->important();
                $data['errors'] = $validator->errors();
            }
        }

        return view('backend/users/update', $data);
    }
}
