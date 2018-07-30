<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Product;
use App\Model\Category;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    protected $handle_cart;
    public function __construct(HandleCartController $handlecart)
    {
        $this->handle_cart = $handlecart;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = Category::all();
        $data['mightAlsoLike'] = Product::mightAlsoLike()->get();

        return view('frontend/cart', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', 'Item is already in your cart!');
        }

        Cart::add($request->id, $request->name, $request->quantity, $request->final_price)
            ->associate('App\Model\Product');

        return redirect()->route('cart.index')->with('success_message', 'Item was added to your cart!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCartItem(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric'
        ]);
        //Check row id exist then update
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });

        if ($validator->fails() || $duplicates->isEmpty()) {
            return response()->json(['success' => false]);
        }

        $rowId = $duplicates->first()->rowId;

        Cart::update($rowId, $request->quantity);

        $zero = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });
        if($zero->isEmpty()){
            $zero = $id;
        }else{
            $zero = null;
        }

        $cart_content = Cart::content();

        $cart_items = [];
        $content = [];
        foreach($cart_content as $item)
        {
            $cart_items['image'] = getFeaturedImageProduct($item->model->image);
            $cart_items['name'] = $item->name;
            $cart_items['qty'] = $item->qty;
            $cart_items['price'] = presentPrice($item->price);

            $content[] = $cart_items;
        }

        return response()->json([
            'success' => true,
            'count' => Cart::count(),
            'subtotal' => presentPrice(Cart::subtotal()),
            'cart_items' => $content,
            'total' => presentPrice(Cart::total()),
            'remove_id' => $zero,
            'message' => 'Giỏ hàng đã được cập nhật'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCartItem($id)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });

        if ($duplicates->isNotEmpty()) {

            $rowId = $duplicates->first()->rowId;
            Cart::remove($rowId);

            $cart_content = Cart::content();

            $cart_items = [];
            $content = [];
            foreach($cart_content as $item)
            {
                $cart_items['image'] = getFeaturedImageProduct($item->model->image);
                $cart_items['name'] = $item->name;
                $cart_items['qty'] = $item->qty;
                $cart_items['price'] = presentPrice($item->price);

                $content[] = $cart_items;
            }

            return response()->json([
                'success' => true,
                'count' => Cart::count(),
                'subtotal' => presentPrice(Cart::subtotal()),
                'cart_items' => $content,
                'total' => presentPrice(Cart::total()),
                'message' => 'Giỏ hàng đã được cập nhật'
            ]);
        }else{

            return response()->json([
                'message' => 'Item không tồn tại',
                'success' => false
            ]);
        }


    }

    /**
     * Switch item for shopping cart to Save for Later.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToSaveForLater($id)
    {
        $item = Cart::get($id);

        Cart::remove($id);

        $duplicates = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', 'Item is already Saved For Later!');
        }

        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)
            ->associate('App\Model\Product');

        return redirect()->route('cart.index')->with('success_message', 'Item has been Saved For Later!');
    }

    public function addCartShopPage(Request $request)
    {
        if ($request->isMethod('post')){

            $validator = Validator::make($request->all(), [
                'quantity' => 'required|numeric|min:1'
            ]);

            if($validator->fails()){
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng nhỏ nhất là 1. Xin vui lòng nhập lại.'
                ]);
            }

            $product = Product::where('id',$request->id)->first();
            $quantity = $request->quantity ?? 1;

            if($this->handle_cart->checkItemQuantity($product->id, $quantity) == false){
                $message = 'Số lượng không hợp lệ, xin vui lòng nhập số lượng nhỏ hơn '. $product->quantity;

                return response()->json([
                    'success' => false,
                    'message' => $message,
                ]);
            }

            $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
                return $cartItem->id === $request->id;
            });

            if ($duplicates->isNotEmpty()) {
                $rowId = $duplicates->first()->rowId;
                $qty_incart = $duplicates->first()->qty;
                Cart::update( $rowId, $qty_incart + $quantity);
                $message = 'Bạn đã thêm '.$quantity.' '.$product->name.' vào giỏ hàng';
            }else{
                Cart::add($request->id, $request->name, $quantity, $request->final_price)
                    ->associate('App\Model\Product');

                $message = 'Bạn đã thêm '.$quantity.' '.$product->name.' vào giỏ hàng';
            }

            $cart_content = Cart::content();

            $cart_items = [];
            $content = [];
            foreach($cart_content as $item)
            {
                $cart_items['image'] = getFeaturedImageProduct($item->model->image);
                $cart_items['name'] = $item->name;
                $cart_items['qty'] = $item->qty;
                $cart_items['price'] = presentPrice($item->price);

                $content[] = $cart_items;
            }

//            dd($cart_content);

            return response()->json([
                    'status' => 'success',
                    'message' => $message,
                    'count' => Cart::count(),
                    'subtotal' => presentPrice(Cart::subtotal()),
                    'image' => url(getFeaturedImageProduct($product->image)),
                    'cart_items' => $content
                ],200);
        }else{
            return response()->json([
                'message' => 'Không thể thêm sản phẩm vào giỏ hàng',
                'status' => 'error'
                ],
                400);
        }
    }
}
