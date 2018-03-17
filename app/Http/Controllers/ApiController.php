<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 *
 * @SWG\SecurityScheme(
 *   in="header",
 *   name="Access-Token",
 *   securityDefinition="Access-Token",
 *   type="apiKey"
 * )
 *
 * This class should be parent class for other API controllers
 * Class Controller
 */
class ApiController extends Controller
{

}
