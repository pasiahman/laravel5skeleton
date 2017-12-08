<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Termmeta extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'term_id', 'key', 'value',
    ];

    protected $table = 'termmeta';
}
