<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Attribute;
use App\Model\Product;
use App\Model\Post;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    function __construct() {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('parent_id',0)
            ->where('active',1)
            ->orderBy('order')
            ->get();
        $featured = Product::where('active',1)
            ->where('featured', 1)->where('type_id','simple')
            ->take(6)->get();
        $group = Product::where('active',1)
           ->where('type_id','group')
            ->take(5)->get();

        return view($this->frontend_view.'/home');
    }

    public function quickView(Request $request)
    {
        $slug = $request->q;
        $product = Product::where('slug', $slug)->first();
        $product->image = getFeaturedImageProduct($product->image);

        $final_price = Product::getFinalPrice($product);
        $product->priceformat = presentPrice($final_price);
        $product->price = $final_price;
        $data = [
            'product' => $product,
        ];
        return response()->json($data, 200);
    }

    public function catalogCategory($slug, Request $request)
    {
        $pagination = 9;
        $category = Category::where('slug', $slug)->first();

        $products = $category->products();

        $products = $this->_toolbar->filterCollection($products);

        $products = $products->paginate($pagination);

        foreach($products as $key =>  $product)
        {
            $product->final_price = Product::getFinalPrice($product);
        }

        if($request->session()->has('category')){
            $request->session()->forget('category');
        }
        $request->session()->put('category', [
            'name' => $category->name,
            'slug' => $category->slug
        ]);

        $data['products'] = $products;
        $data['category'] = $category;

        return view('frontend/shop', $data);
    }

    public function allProduct(Request $request)
    {
        $pagination = 9;
        $products = Product::where('active',1)->paginate($pagination);

        foreach($products as $key =>  $product)
        {
            $product->final_price = Product::getFinalPrice($product);
        }

        if($request->session()->has('category')){
            $request->session()->forget('category');
        }

        $data['products'] = $products;
        return view('frontend/shop', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param Product Slug $slug
     * @return \Illuminate\Http\Response
     */
    public function catalogProduct($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $product->final_price = Product::getFinalPrice($product);

        $data['product'] = $product;

        if($product->type_id == 'group'){
            $child_id = json_decode($product->child_id);

            $child_products = Product::whereIn('id', (array)$child_id)->get();

            foreach($child_products as $product)
            {
                $product->final_price = Product::getFinalPrice($product);
            }

            $data['child_products'] = $child_products;

            return view('frontend/catalog/product/combo-detail',$data);
        }

        return view('frontend/catalog/product/simple-product',$data);
    }

    public function search(Request $request)
    {
        $pagination = 9;
        $query = $request->input('q');
        $products = Product::where('name', 'like', "%$query%")
                            ->orWhere('sku', 'like', "%$query%");

        $products = $this->_toolbar->filterCollection($products);
        $products = $products->paginate($pagination);
        $data['products'] = $products;

        if($request->session()->has('category')){
            $request->session()->forget('category');
        }
//        $result = [];
//
//        foreach ($products as $product){
//            $result[] = [
//                'name' => $product->name,
//                'image' => url(getFeaturedImageProduct($product->image)),
//                'final_price' => presentPrice(Product::getFinalPrice($product))
//            ];
//        }

        return view('frontend/shop', $data);
    }
}
