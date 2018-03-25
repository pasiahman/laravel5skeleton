<?php

namespace App\Http\Api;

class AuthenticationController extends \Modules\Authentication\Http\Controllers\Api\AuthenticationController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @SWG\Post(
     *      path="/api/authentication/login",
     *      summary="",
     *      description="",
     *      produces={"application/json"},
     *      tags={"authentication"},
     *      @SWG\Parameter(name="email", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Parameter(name="password", type="string", format="password", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Response(response=200, description="OK"),
     *      @SWG\Response(response=401, description="Unauthorized"),
     *      @SWG\Response(response=422, description="Unprocessable Entity"),
     * )
     */

    /**
     * @SWG\Post(
     *      path="/api/authentication/password/forgot",
     *      summary="",
     *      description="",
     *      produces={"application/json"},
     *      tags={"authentication"},
     *      @SWG\Parameter(name="email", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Response(response=200, description="OK"),
     *      @SWG\Response(response=422, description="Unprocessable Entity"),
     * )
     */

    /**
     * @SWG\Post(
     *      path="/api/authentication/password/reset",
     *      summary="",
     *      description="",
     *      produces={"application/json"},
     *      tags={"authentication"},
     *      @SWG\Parameter(name="email", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Parameter(name="password", type="string", format="password", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Parameter(name="password_confirmation", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Parameter(name="verification_code", type="string", in="formData", required=true, description="varchar(6)"),
     *      @SWG\Response(response=200, description="OK"),
     *      @SWG\Response(response=422, description="Unprocessable Entity"),
     * )
     */

    /**
     * @SWG\Post(
     *      path="/api/authentication/register",
     *      summary="",
     *      description="",
     *      produces={"application/json"},
     *      tags={"authentication"},
     *      @SWG\Parameter(name="name", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Parameter(name="email", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Parameter(name="password", type="string", format="password", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Response(response=200, description="OK"),
     *      @SWG\Response(response=422, description="Unprocessable Entity"),
     * )
     */

    /**
     * @SWG\Post(
     *      path="/api/authentication/verified",
     *      summary="",
     *      description="",
     *      produces={"application/json"},
     *      tags={"authentication"},
     *      @SWG\Parameter(name="email", type="string", in="formData", required=true, description="varchar(191)"),
     *      @SWG\Parameter(name="password", type="string", format="password", in="formData", required=true, description="varchar(6)"),
     *      @SWG\Response(response=200, description="OK"),
     *      @SWG\Response(response=422, description="Unprocessable Entity"),
     * )
     */

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
}
