<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;

class HandleCheckoutController extends Controller
{
    public function updateProductQuantity($id, $quantity)
    {
        $product = Product::findOrFail($id);
        $qty_update =  $product->quantity > $quantity ? $product->quantity - $quantity : $product->quantity;
        $product->quantity  = $qty_update;
        $product->save();
    }
}
