<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Models\Users;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    /**
     * @SWG\Post(
     *      path="/api/authentication/login",
     *      summary="",
     *      description="",
     *      produces={"application/json"},
     *      tags={"authentication"},
     *      @SWG\Parameter(name="email", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Parameter(name="password", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Response(response=200, description="OK"),
     *      @SWG\Response(response=401, description="Unauthorized"),
     *      @SWG\Response(response=422, description="Unprocessable Entity"),
     * )
     */
    public function login(\App\Http\Requests\API\Authentication\LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $user->access_token = Hash::make(time());
            $user->save();

            $data['access_token'] = $user->access_token;
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => trans('auth.failed')], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * @SWG\Post(
     *      path="/api/authentication/register",
     *      summary="",
     *      description="",
     *      produces={"application/json"},
     *      tags={"authentication"},
     *      @SWG\Parameter(name="name", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Parameter(name="email", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Parameter(name="password", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Response(response=200, description="OK"),
     *      @SWG\Response(response=422, description="Unprocessable Entity"),
     * )
     */
    public function register(\App\Http\Requests\API\Authentication\RegisterRequest $request)
    {
        $user = new Users;
        $user->fill($request->input());
        $user->password = Hash::make($user->password);
        $user->verification_code = rand(111111, 999999);
        $user->save();

        $user->notify(new \App\Notifications\Users\VerificationCodeVerify($user));

        $data['verification_code'] = $user->verification_code;
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * @SWG\Post(
     *      path="/api/authentication/verified",
     *      summary="",
     *      description="",
     *      produces={"application/json"},
     *      tags={"authentication"},
     *      @SWG\Parameter(name="email", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Parameter(name="password", type="string", in="formData", required=true, description="varchar(6)"),
     *      @SWG\Response(response=200, description="OK"),
     *      @SWG\Response(response=422, description="Unprocessable Entity"),
     * )
     */
    public function verified(\App\Http\Requests\API\Authentication\LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $data['verified'] = Auth::user()->verified;
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => trans('auth.failed')], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * @SWG\Post(
     *      path="/api/authentication/verify",
     *      summary="",
     *      description="",
     *      produces={"application/json"},
     *      tags={"authentication"},
     *      @SWG\Parameter(name="email", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Parameter(name="verification_code", type="string", in="formData", required=true, description="varchar(6)"),
     *      @SWG\Response(response=200, description="OK"),
     *      @SWG\Response(response=422, description="Unprocessable Entity"),
     * )
     */
    public function verify(\App\Http\Requests\API\Authentication\VerifyRequest $request)
    {
        $user = Users::where('email', $request->input('email'))->firstOrFail();
        $user->verified = 1;
        $user->save();

        $data['verified'] = $user->verified;
        return response()->json($data, Response::HTTP_OK);
    }
}
