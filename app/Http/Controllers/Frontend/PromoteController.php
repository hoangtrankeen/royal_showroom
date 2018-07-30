<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Manager\Catalog;
use App\Model\Product;
use App\Model\Post;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PromoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCombo()
    {
        $data['combos'] = Product::where('type_id','group')
            ->get();

        return view('frontend/promotion/list-combo', $data);
    }
}
