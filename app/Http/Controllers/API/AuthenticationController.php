<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Models\Users;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    /**
     * @SWG\Post(
     *      path="/api/authentication/register",
     *      summary="",
     *      description="",
     *      produces={"application/json"},
     *      tags={"authentication"},
     *      @SWG\Parameter(name="name", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Parameter(name="email", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Parameter(name="password", type="integer", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Response(response=200, description="OK"),
     *      @SWG\Response(response=422, description="Unprocessable Entity"),
     * )
     */
    public function register(\App\Http\Requests\API\Authentication\RegisterRequest $request)
    {
        $user = new Users;
        $user->fill($request->input());
        $user->password = Hash::make($user->password);
        $user->save();

        $data['access_token'] = $user->createToken('MyApp')->accessToken;
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * @SWG\Post(
     *      path="/api/authentication/register-email-phone-number",
     *      summary="",
     *      description="",
     *      produces={"application/json"},
     *      tags={"authentication"},
     *      @SWG\Parameter(name="email", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Parameter(name="phone_number", type="string", in="formData", required=true, description="varchar(20)"),
     *      @SWG\Parameter(name="password", type="integer", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Response(response=200, description="OK"),
     *      @SWG\Response(response=422, description="Unprocessable Entity"),
     * )
     */
    public function registerEmailPhoneNumber(\App\Http\Requests\API\Authentication\RegisterEmailPhoneNumberRequest $request)
    {
        $user = new Users;
        $user->fill($request->input());
        $user->password = Hash::make($user->password);
        $user->save();

        $data['access_token'] = $user->createToken('MyApp')->accessToken;
        return response()->json($data, Response::HTTP_OK);
    }
}
