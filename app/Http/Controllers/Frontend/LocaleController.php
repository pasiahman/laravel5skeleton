<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class LocaleController extends Controller
{
    public function setLocale($locale = null)
    {
        $languages = array_keys(config('app.languages'));

        if (! in_array($locale, $languages)) {
            $locale = config('app.locale');
        }

        session()->put('locale', $locale);

        if ($referer = request()->headers->get('referer')) {
            return redirect()->back();
        } else {
            return redirect()->to('');
        }
    }
}
