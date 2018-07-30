<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;

class HandleCartController extends Controller
{
    public function checkItemQuantity($id, $quantity)
    {
        $product = Product::findOrFail($id);

        if($product->quantity <= $quantity){
            return false;
        }
        return true;
    }
}
