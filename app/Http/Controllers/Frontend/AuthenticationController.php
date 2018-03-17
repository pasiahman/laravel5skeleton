<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Models\Users;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('frontend/default/authentication/login');
    }

    public function loginStore(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->has('remember'))) {
            return redirect()->intended(route('frontend'));
        } else {
            return redirect()->back()->withErrors(['email' => [trans('auth.failed')]]);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logoutStore(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    public function register()
    {
        return view('frontend/default/authentication/register');
    }

    public function registerStore(\App\Http\Requests\Frontend\Authentication\RegisterStoreRequest $request)
    {
        $user = new Users();
        $user->fill($request->input());
        $user->password = Hash::make($user->password);
        $user->verified = 0;
        $user->verification_code = rand(111111, 999999);
        $user->save();
        Auth::login($user);
        return redirect()->route('frontend');
    }

    public function verify(Request $request)
    {
        $data['user'] = Users::where('email', $request->query('email'))->firstOrFail();
        return view('frontend/default/authentication/verify', $data);
    }

    public function verifyStore(\App\Http\Requests\API\Authentication\VerifyRequest $request)
    {
        $user = Users::where('email', $request->input('email'))->firstOrFail();
        $user->verified = 1;
        $user->save();
        flash(__('cms.verification_success'))->success()->important();
        return redirect()->route('frontend');
    }
}
