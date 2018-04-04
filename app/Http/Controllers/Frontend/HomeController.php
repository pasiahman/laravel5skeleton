<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Posts\Models\Posts;

class HomeController extends Controller
{
    public function index()
    {
        $data['posts'] = Posts::with(['author', 'postmetas'])->where('status', 'publish')->orderBy('updated_at', 'DESC')->paginate(5);
        return view('frontend/default/home/index', $data);
    }
}
