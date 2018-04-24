<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Options\Models\Options;
use Modules\Pages\Models\Pages;

class FrontendController extends Controller
{
    public function index()
    {
        $data['frontendHomePage'] = $frontendHomePage = Options::where('name', 'frontend_home_page')->firstOrFail();
        $data['page'] = Pages::findOrFail($frontendHomePage->value);

        return view()->first(
            [
                'cms::frontend/default/pages/templates/home',
            ],
            $data
        );
    }
}
