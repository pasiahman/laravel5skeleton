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
        $request->query('sort') ?: $request->query->set('sort', 'name,ASC');
        $request->query('limit') ?: $request->query->set('limit', 10);

        $data['request'] = $request;
        $data['users'] = Users::search($request->query())->paginate($request->query('limit'));

        return view('backend/users/index', $data);
    }

    public function create(Request $request)
    {
        $data['user'] = $user = new Users;

        if ($request->input('create')) {
            $request->merge(['password' => Hash::make($request->input('password'))]);
            $user->fill($request->input())->save();
            return redirect()->route('backendUsers');
        }

        return view('backend/users/create', $data);
    }

    public function delete($id)
    {
        Users::find($id)->delete($id);
        return redirect()->route('backendUsers');
    }

    public function update(Request $request)
    {
        $data['user'] = $user = Users::find($request->input('id'));

        if ($request->input('update')) {
            $request->merge(['password' => Hash::make($request->input('password'))]);
            $user->fill($request->input())->save();
            return redirect()->route('backendUsers');
        }

        return view('backend/users/update', $data);
    }
}
