<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserVerified
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
        $user = Auth::user();

        if (! $user->verified) {
            $user->notify(new \App\Notifications\Users\VerificationCodeVerify($user));

            $errors = ['message' => trans('validation.custom.users.user_is_not_yet_verified')];

            if ($request->expectsJson()) {
                return response()->json($errors, Response::HTTP_UNAUTHORIZED);
            } else {
                return redirect()->route('frontend.authentication.verify', ['email' => $user->email]);
            }
        }

        return $next($request);
    }
}
