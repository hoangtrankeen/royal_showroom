<?php

namespace App\Http\BusinessLayer\FrontStore;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ToolBar extends Controller
{
    public $request;
    public $attribute;

    public function __construct(
        Request $request,
        \App\Model\Attribute $attribute
    )
    {
        $this->request = $request;
        $this->attribute = $attribute;
    }

    public function filterCollection($products)
   {
       $attributes = $this->attribute->with('attributeValue')->where('active' , 1)->get();
       if($this->request->has('sort')) {
           if (request()->sort == 'price_asc') {
               $products = $products->orderBy('price', 'asc');
           } elseif (request()->sort == 'price_desc') {
               $products = $products->orderBy('price', 'desc');
           } elseif (request()->sort == 'name_asc') {
               $products = $products->orderBy('name', 'asc');
           }elseif (request()->sort == 'name_desc') {
               $products = $products->orderBy('name', 'desc');
           } elseif (request()->sort == 'featured') {
               $products = $products->where('featured', '1');
           } elseif (request()->sort == 'combo') {
               $products = $products->where('type_id','group');
           }
       }

       if($this->request->has('attribute') == 'attribute'){
           foreach($attributes as $attribute){
               foreach($attribute->attributeValue as $val)
               {
                   if($this->request->attribute == $val->id){
                       $products = $products->whereHas('attributeValue', function ($query) use ($val){
                           $query->where('attribute_value.id',$val->id);
                       });
                   }
               }
           }
       }
       return $products;
   }
}
