<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 8/5/2018
 * Time: 9:50 PM
 */

namespace App\Http\BusinessLayer\FrontStore;

class HandleCheckout
{
    protected $product;

    public function __construct(
        \App\Model\Product $product
    )
    {
        $this->product = $product;
    }

    public function updateProductQuantity($id, $quantity)
    {
        $product = $this->product->findOrFail($id);

        if($product->quantity > $quantity) {
            $product->quantity  =  $product->quantity - $quantity;
            $product->save();
            return true;
        }

        return false;
    }
}