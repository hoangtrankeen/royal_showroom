<?php

namespace App\Http\Controllers\Frontend;

use App\Exceptions\EmptyCollectionException;
use App\Helpers\Royal\StoreManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    protected $product;
    protected $category;
    protected $post;
    protected $attribute;
    protected $toolbar;

    function __construct(
        \App\Model\Product $product,
        \App\Model\Category $category,
        \App\Model\Attribute $attribute,
        \App\Http\BusinessLayer\FrontStore\Toolbar $toolbar
    ) {
         $this->product = $product;
         $this->category = $category;
         $this->attribute = $attribute;
         $this->toolbar = $toolbar;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend/content/home');
    }

    public function quickView(Request $request)
    {
        $slug = $request->q;
        $product = $this->product->where('slug', $slug)->first();
        $product->image = getProductImage($product->images);
        $final_price = StoreManager::getFinalPrice($product);
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

        $category = $this->category->where('slug',$slug)->first();

        if(!count($category)){
            throw new EmptyCollectionException;
        }

        $products = $category->products();

        $products = $this->toolbar->filterCollection($products);

        $products = $products->paginate($pagination);

        if($request->session()->has('category')){
            $request->session()->forget('category');
        }
        $request->session()->put('category', [
            'name' => $category->name,
            'slug' => $category->slug
        ]);

        return view('frontend/content/catalog/shop', compact('products', 'category'));
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
        $product = $this->product->where('slug', $slug)->firstOrFail();
        $product->final_price =  StoreManager::getFinalPrice($product);

        if($product->type_id == 'group'){
            $child_id = json_decode($product->child_id);
            $child_products = $this->product->whereIn('id', $child_id)->get();
            return view('frontend/content/catalog/product/combo-detail',compact('child_products', 'product'));
        }

        return view('frontend/content/catalog/product/simple-product',compact('product'));
    }

    public function search(Request $request)
    {
        $pagination = 9;
        $query = $request->input('q');
        $products = $this->product->where('name', 'like', "%$query%")
                            ->orWhere('sku', 'like', "%$query%");

        $products = $this->toolbar->filterCollection($products);
        $products = $products->paginate($pagination);

        if($request->session()->has('category')){
            $request->session()->forget('category');
        }

        $search_page = true;

        return view('frontend/content/catalog/shop', compact('products','search_page'));
    }
}
