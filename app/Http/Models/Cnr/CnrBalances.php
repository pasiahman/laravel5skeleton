<?php

namespace App\Http\Models\Cnr;

use Illuminate\Database\Eloquent\Model;

class CnrBalances extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'amount'];

    protected $table = 'cnr_balances';

    public function user()
    {
        return $this->belongsTo('App\Http\Models\Users', 'id', 'user_id');
    }
}
