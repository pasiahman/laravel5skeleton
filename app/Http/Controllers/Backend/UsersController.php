<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $data['users'] = User::all();
        return view('backend/users/index', $data);
    }

    public function create(Request $request)
    {
        $data['user'] = $user = new User;

        if ($request->input('create')) {
            $request->merge(['password' => Hash::make($request->input('password'))]);
            $user->fill($request->input())->save();
            return redirect()->route('backendUsers');
        }

        return view('backend/users/create', $data);
    }

    public function delete($id)
    {
        User::find($id)->delete($id);
        return redirect()->route('backendUsers');
    }

    public function update(Request $request)
    {
        $data['user'] = $user = User::find($request->input('id'));

        if ($request->input('update')) {
            $request->merge(['password' => Hash::make($request->input('password'))]);
            $user->fill($request->input())->save();
            return redirect()->route('backendUsers');
        }

        return view('backend/users/update', $data);
    }
}
