<?php

namespace App\Http\Controllers\API\Cnr;

use App\Http\Controllers\Controller;
use App\Http\Models\Cnr\CnrBalances;
use App\Http\Models\Cnr\UserDetails;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UserBalanceController extends Controller
{
    /**
     * @SWG\Get(
     *      path="/api/user_balance",
     *      summary="",
     *      description="",
     *      produces={"application/json"},
     *      operationId="",
     *      tags={"users"},
     *      @SWG\Parameter(
     *          name="phone_number",
     *          in="query",
     *          required=true,
     *          type="string",
     *          description="Phone Number",
     *      ),
     *      @SWG\Response(response=200, description="OK"),
     *      @SWG\Response(response=404, description="Not Found"),
     * )
     */
    public function index(Request $request)
    {
        $userDetail = UserDetails::where('phone_number', $request->query('phone_number'))->firstOrFail();
        return new \App\Http\Resources\API\Cnr\UserBalanceResource($userDetail);
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
}
