<?php

namespace App\Http\Controllers\API\Cnr;

use App\Http\Models\Cnr\CnrTransactions;
use App\Http\Models\Cnr\UserDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @SWG\Post(
     *      path="/api/transactions",
     *      summary="",
     *      description="",
     *      produces={"application/json"},
     *      operationId="",
     *      tags={"transactions"},
     *      @SWG\Parameter(name="reference_number", type="string", in="formData", required=true, description="varchar(50)"),
     *      @SWG\Parameter(name="total", type="integer", in="formData", required=true, description="bigint(20)"),
     *      @SWG\Parameter(name="cnr_cash", type="integer", in="formData", required=true, description="bigint(50)"),
     *      @SWG\Parameter(name="phone_number", type="string", in="formData", required=true, description="varchar(50)"),
     *      @SWG\Parameter(name="verification_code", type="string", in="formData", required=true, description="varchar(10)"),
     *      @SWG\Response(response=200, description="OK"),
     *      @SWG\Response(response=404, description="Not Found"),
     *      @SWG\Response(response=422, description="Unprocessable Entity"),
     * )
     */
    public function store(\App\Http\Requests\API\Cnr\Transactions\StoreRequest $request)
    {
        $transaction = CnrTransactions::create($request->input());

        $userDetail = UserDetails::where('phone_number', $request->input('phone_number'))->first();
        $userDetail->balance->amount -= $request->input('cnr_cash');
        $userDetail->balance->save();

        return new \App\Http\Resources\API\Cnr\UserBalanceResource($userDetail);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
