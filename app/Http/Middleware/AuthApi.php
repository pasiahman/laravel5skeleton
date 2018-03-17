<?php

namespace App\Http\Middleware;

use App\Http\Models\Users;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($user = Users::where('access_token', $request->header('Access-Token'))->first()) {
            Auth::login($user);
        } else {
            return response()->json(['message' => trans('auth.failed')], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
