<?php

namespace App\Http\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UsersSocialite extends Model
{
    protected $table = 'users_socialite';

    protected $fillable = [
        'user_id', 'provider', 'client_id', 'code', 'email', 'username', 'data',
    ];

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $socialite
     * @param $provider
     * @return User
     */
    public function findOrCreate($socialite, $provider)
    {
        if ($user = User::where('email', $socialite->email)->first()) {
        } else {
            $user = User::create([
                'name' => $socialite->email,
                'password' => Hash::make(time()),
                'email' => $socialite->email,
            ]);
        }

        if ($usersSocialite = self::where('user_id', $user->id)->where('client_id', $socialite->id)->first()) {
        } else {
            self::create([
                'user_id' => $user->id,
                'provider' => $provider,
                'client_id' => $socialite->id,
                'email' => $socialite->email,
                'data' => json_encode($socialite->user),
            ]);
        }

        return $user;
    }
}
