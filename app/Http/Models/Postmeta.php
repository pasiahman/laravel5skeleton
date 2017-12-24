<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Postmeta extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id', 'key', 'value',
    ];

    protected $table = 'postmeta';
}
