<?php

namespace App\Http\Models\Cnr;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['phone_number', 'api_token', 'verification_code'];

    protected $table = 'user_details';
}
