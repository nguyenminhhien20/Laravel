<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function about()
    {
        return view('frontend.about');
    }
}
