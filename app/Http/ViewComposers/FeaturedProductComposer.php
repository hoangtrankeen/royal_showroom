<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class FeaturedProductComposer
{
    protected $product;


    public function __construct(
        \App\Model\Product $product
    )
    {
        $this->product = $product;
    }

    public function compose(View $view)
    {
        $share_featured_product = $this->product->where('featured',1)->orderBy('sort_order')->first();
        $view->with('share_featured_product', $share_featured_product);
    }


}