<?php

namespace App\Http\BusinessLayer\FrontStore;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;

class HandleCart extends Controller
{
    public $product;
    public function __construct(
        Product $product
    )
    {
        $this->product = $product;
    }
    public function checkAvailableQuantity($id, $quantity)
    {
        $product = $this->product->findOrFail($id);

        if($product->quantity <= $quantity){
            return false;
        }
        return true;
    }
}
