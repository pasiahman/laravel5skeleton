<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Models\Posts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['posts'] = Posts::with(['author', 'postmetas'])->where('status', 'publish')->orderBy('updated_at', 'DESC')->paginate(5);
        return view('frontend/default/home/index', $data);
    }
}
