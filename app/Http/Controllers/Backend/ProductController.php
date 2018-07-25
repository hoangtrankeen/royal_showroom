<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $product;
    protected $image_handler;
    protected $category;
    protected $attribute;
    protected $product_attribute;
    protected $attribute_value;
    protected $type_id;
    protected $img_product_dir;
    protected $view;

    public function __construct(
        \App\Model\Product $product,
        \App\Http\BusinessLayer\MediaManager\ImageHandler $image_handler,
        \App\Model\Category $category,
        \App\Model\Attribute $attribute,
        \App\Model\ProductAttribute $product_attribute,
        \App\Model\AttributeValue $attribute_value
    )
    {
        $this->product = $product;
        $this->image_handler = $image_handler;
        $this->category = $category;
        $this->attribute = $attribute;
        $this->product_attribute = $product_attribute;
        $this->attribute_value = $attribute_value;
        $this->type_id = 'simple';
        $this->view = 'backend/content/product/';
        $this->img_product_dir = getProductImagePath();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->all();
        return view($this->view.'index',compact('products'));
    }

    public function create(Request $request)
    {
        $products = $this->product->getSimpleProduct();
        $categories = $this->category->all();

        if($request->type == 'group'){
            return view($this->view.'create-group', compact('products', 'categories'));
        }
        if($request->type == 'simple'){
            $attributes = $this->attribute->all();
            return view($this->view.'create-simple', compact('products','categories','attributes'));
        }

        Session::flash('error','Product Type not Exist');
        return  redirect()->route('product.index');
    }

    public function edit($id)
    {
        $product = $this->product->findOrFail($id);

        $cat_ids = [];
        foreach ($product->categories as $category)
        {
            $cat_ids[] = $category->id;
        }

        $categories = $this->category->all();

        $attributes = $this->attribute->all();

        if($product->type_id == 'group'){

            $all_products = $this->product->getSimpleProduct();

            if($product->child_id){
                $child_id = json_decode($product->child_id);
            }else {
                $child_id = [];
            }
            $child_products = $this->product->whereIn('id', $child_id)->get();

            return view($this->view.'edit-group', compact('all_products', 'attributes', 'product', 'categories', 'cat_ids', 'child_products'));
        }

        if($product->type_id == 'simple'){
            return view($this->view.'edit-simple', compact('categories','attributes', 'product', 'cat_ids'));
        }

        Session::flash('error', 'The Product Type not exist');
        return redirect()->back();
    }
}
