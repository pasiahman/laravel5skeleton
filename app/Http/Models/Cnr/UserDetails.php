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

    public function balance()
    {
        return $this->hasOne('\App\Http\Models\Cnr\CnrBalances', 'user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('\App\Http\Models\Users');
    }
}
