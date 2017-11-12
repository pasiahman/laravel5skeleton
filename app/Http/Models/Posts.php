<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Posts extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author', 'title', 'name', 'content', 'type', 'mime_type', 'status', 'comment_status', 'comment_count',
    ];

    protected $table = 'posts';
}
