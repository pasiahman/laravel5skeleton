<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $data['post'] = Posts::search('name', $request->query('name'))->firstOrFail();
        return view('frontend/default/posts/index', $data);
    }
}
