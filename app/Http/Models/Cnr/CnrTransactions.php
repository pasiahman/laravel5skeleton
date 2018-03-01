<?php

namespace App\Http\Models\Cnr;

use Illuminate\Database\Eloquent\Model;

class CnrTransactions extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference_number',
        'total',
        'cnr_cash',
        'point',
        'user_id',
        'phone_number',
    ];

    protected $table = 'cnr_transactions';

    public function user()
    {
        return $this->belongsTo('App\Http\Models\Users', 'id', 'user_id');
    }
}
