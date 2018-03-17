<?php

namespace App\Http\Controllers\API;

use App\Http\API\Controller;
use App\Http\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * @SWG\Get(
     *      path="/api/users",
     *      summary="",
     *      description="",
     *      produces={"application/json"},
     *      tags={"users"},
     *      @SWG\Response(response=200, description="OK"),
     * )
     */
    public function index()
    {
        $users = Users::paginate();
        return new \App\Http\Resources\API\UsersResource($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    /**
     * @SWG\Get(
     *      path="/api/users/profile",
     *      summary="",
     *      description="
     *          {
     *              'data': {
     *                  'id': 13,
     *                  'name': 'Jovi',
     *                  'email': 'jovi@mailinator.com',
     *                  'phone_number': '087877118199',
     *                  'api_token': null,
     *                  'verification_code': '700450',
     *                  'created_at': {
     *                      'date': '2018-03-15 03:33:42.000000',
     *                      'timezone_type': 3,
     *                      'timezone': 'UTC'
     *                  },
     *                  'updated_at': {
     *                      'date': '2018-03-15 03:34:05.000000',
     *                      'timezone_type': 3,
     *                      'timezone': 'UTC'
     *                  }
     *              }
     *          }
     *      ",
     *      produces={"application/json"},
     *      tags={"users"},
     *      security={
     *          { "Access-Token": {} }
     *      },
     *      @SWG\Response(response=200, description="OK"),
     *      @SWG\Response(response=401, description="Unauthorized"),
     * )
     */
    public function profileShow()
    {
        $user = Auth::user();
        return new \App\Http\Resources\API\UserResource($user);
    }

    /**
     * @SWG\Put(
     *      path="/api/users/profile",
     *      summary="",
     *      description="",
     *      produces={"application/json"},
     *      tags={"users"},
     *      security={
     *          { "Access-Token": {} }
     *      },
     *      @SWG\Parameter(name="name", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Parameter(name="email", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Parameter(name="phone_number", type="string", in="formData", required=true, description="varchar(20)"),
     *      @SWG\Parameter(name="password", type="integer", in="formData", required=false, description="varchar(191)"),
     *      @SWG\Response(response=200, description="OK"),
     *      @SWG\Response(response=401, description="Unauthorized"),
     *      @SWG\Response(response=422, description="Unprocessable Entity"),
     * )
     */
    public function profileUpdate(\App\Http\Requests\API\Users\ProfileUpdateRequest $request)
    {
        $request->input('password') ? $request->merge(['password' => Hash::make($request->input('password'))]) : $request->request->remove('password');
        $user = Auth::user();
        $user->fill($request->input())->save();
        return response()->json($user);
    }
}
