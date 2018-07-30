<?php

namespace App\Helpers\Royal;
use App\Model\Category;
use App\Model\Product;
use Carbon\Laravel\ServiceProvider;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/30/2018
 * Time: 11:32 PM
 */
class StoreManager extends ServiceProvider
{
    public static function getFinalPrice($product)
    {
        if($product->discount_price !== null) {
            return $product->discount_price;
        }
        return $product->price;
    }

    public static function getCategories()
    {
        return Category::where('active',1)
            ->where('parent_id',0)->get();
    }

    public static function getGroupProducts()
    {
        return Product::where('active',1)
            ->where('type_id','group')->get();
    }

    public static function getFeaturedProducts()
    {
        return Product::where('featured',1)
            ->where('active',1)->get();
    }
}