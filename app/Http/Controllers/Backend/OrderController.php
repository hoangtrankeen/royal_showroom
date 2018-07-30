<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Royal\StoreManager;
use Carbon\Carbon;
use App\Mail\SendOrderConfirmation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    protected $order;
    protected $payment_method;
    protected $product;
    protected $order_product;
    protected $order_status;

    public function __construct(
        \App\Model\Order $order,
        \App\Model\PaymentMethod $payment_method,
        \App\Model\Product $product,
        \App\Model\OrderProduct $order_product,
        \App\Model\OrderStatus $order_status
    )
    {
        $this->order = $order;
        $this->payment_method = $payment_method;
        $this->product = $product;
        $this->order_product = $order_product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->order->all();
        return view ('backend/content/order/index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payments = $this->payment_method->all();
        $products = $this->product->all();

        return view('backend/content/order/create', compact('payments','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,array(
                'email' => 'required',
                'name' => 'required',
                'address' => 'required',
                'city' => 'required',
                'province' => 'required',
                'postalcode' => 'required',
                'phone' => 'required',
                'payment_method' => 'required',
                'delivery_date' => 'required|date',
                'order_product' => 'required'
            )
        );

        $this->addToOrdersTables($request);
        Cart::destroy();

        return redirect()->back()->with('success','Tạo đơn hàng thành công');
    }


    /**
     * Update the cart .
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function upDateCart(Request $request)
    {
        foreach($request->arr as $item)
        {
            $item = (int) $item;
            $product = $this->product->findOrFail($item);

            $quantity = $request->quantity ?? 1;
            $duplicates = Cart::search(function ($cartItem, $rowId) use ($item) {
                return $cartItem->id === $item;
            });

            if ($duplicates->isNotEmpty()) {
                $rowId = $duplicates->first()->rowId;
                $qty_incart = $duplicates->first()->qty;
                Cart::update( $rowId, $qty_incart + $quantity);
            }else{
                Cart::add($item, $product->name, $quantity, StoreManager::getFinalPrice($product))
                    ->associate('App\Model\Product');
            }
        }

        return response()->json(['message' => $request->all()]);

    }

    protected function addToOrdersTables($request)
    {

        $delivery_date =  date('Y-m-d', strtotime($request->delivery_date));
        // Insert into orders table
        $order = Order::create([
            'user_id' => null,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_postalcode' => $request->postalcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount' => $this->getNumbers()->get('discount'),
            'billing_discount_code' => $this->getNumbers()->get('code'),
            'billing_subtotal' => $this->getNumbers()->get('newSubtotal'),
            'billing_tax' => $this->getNumbers()->get('newTax'),
            'billing_total' => $this->getNumbers()->get('newTotal'),
            'delivery_date' => $delivery_date,
            'payment_method' => $request->payment_method,
            'status' => 1,
        ]);

        // Insert into order_product table
        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        $order = Order::find($order->id);

        return $order;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $data['statuses'] = OrderStatus::all();

        $products = $order->products;

        foreach($products as $product)
        {
            $product->final_price = Product::getFinalPrice($product);
        }

        $data['order'] = $order;

        $data['products'] = $products;


        return view('backend/order/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            // rules, criteria
            'billing_address' => 'required|string',
            'billing_city' => 'required|string',
            'billing_province' => 'required|string',
            'billing_postalcode' => 'required|string',
            'delivery_date' => 'required|date'
        ));

        $order = Order::find($id);
        $statuses = OrderStatus::all();
        foreach($statuses as $status){
            if($request->has('status_'.$status->id)){
                $order->status = $status->id;
                $order->save();
            }
        }

        $order->billing_city = $request->billing_city;
        $order->billing_address = $request->billing_address;
        $order->billing_province = $request->billing_province;
        $order->billing_postalcode = $request->billing_postalcode;
        $order->delivery_date = $request->delivery_date;

        $order->save();

        return redirect()->back()->with('success', 'Order is updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sendEmailOrder(Request $request)
    {
        $order = Order::find($request->order_id);

        foreach ($order->products as $product)
        {
            $product->final_price = Product::getFinalPrice($product);
        }

        $details =[
            'order_id' => $order->id,
            'billing_email' => $order->billing_email,
            'billing_name' => $order->billing_name,
            'billing_address' => $order->billing_address,
            'billing_city' => $order->billing_city,
            'billing_province' => $order->billing_province,
            'billing_postalcode' => $order->billing_postalcode,
            'billing_phone' => $order->billing_phone,
            'billing_total' => $order->billing_total,
            'payment_method' => $order->payment_methods->name,
            'created_at' => $order->created_at,
            'ordered_products' => $order->products,
            'customer' => auth()->user() ? auth()->user()->name : $order->billing_name,
            'products' => $order->products,
            'status' => $order->statuses->name
        ];

        Mail::to($details['billing_email'])->send(new SendOrderConfirmation($details));

        return redirect()->back()->with('success', 'Order Email has been sent successfully!');
    }

    private function getNumbers()
    {

        $tax = config('cart.tax') / 100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $code = session()->get('coupon')['name'] ?? null;
        $newSubtotal = (Cart::subtotal() - $discount);
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal * (1 + $tax);

        return collect([
            'tax' => $tax,
            'discount' => $discount,
            'code' => $code,
            'newSubtotal' => $newSubtotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal,
        ]);
    }

}
