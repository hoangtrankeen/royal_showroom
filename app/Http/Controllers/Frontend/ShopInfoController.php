<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopInfoController extends Controller
{
    public function contactPage()
    {
        return view('frontend/info/contact');
    }
}
