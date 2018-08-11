<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Checkout\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    protected $handle_checkout;
    protected $payment_method;
    protected $shipping_method;
    protected $order_status;
    protected $order;
    protected $product;
    protected $order_product;

    public function __construct(
        \App\Http\BusinessLayer\FrontStore\HandleCheckout $handleCheckout,
        \App\Model\PaymentMethod $paymentMethod,
        \App\Model\ShippingMethod $shippingMethod,
        \App\Model\OrderStatus $orderStatus,
        \App\Model\Order $order,
        \App\Model\OrderProduct $product,
        \App\Model\OrderProduct $orderProduct
    )
    {
        $this->handle_checkout = $handleCheckout;
        $this->payment_method = $paymentMethod;
        $this->shipping_method = $shippingMethod;
        $this->order_status = $orderStatus;
        $this->order = $order;
        $this->product = $product;
        $this->order_product = $orderProduct;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_methods = $this->payment_method->getAvailablePaymentMethod();
        $shipping_methods = $this->shipping_method->getAvailableShippingMethod();
        $free_ship = $this->shipping_method->where('code','free-ship')->first();
        return view('frontend/content/checkout/checkout', compact('payment_methods', 'shipping_methods', 'free_ship'));
    }

    protected function addToOrdersTables($request)
    {
        $delivery_date =  date('Y-m-d', strtotime($request->delivery_date));
        // Insert into orders table
        $order = $this->order->create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_name' => $request->email,
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'postalcode' => $request->postalcode,
            'phone' => $request->phone,
            'delivery_date' => $delivery_date,
            'customer_message' => $request->customer_message,

            'discount' => $this->getNumbers()->get('discount'),
            'discount_code' => $this->getNumbers()->get('code'),
            'subtotal' => $this->getNumbers()->get('newSubtotal'),
            'tax' => $this->getNumbers()->get('newTax'),
            'total' => $this->getNumbers()->get('newTotal'),

            'payment_method_id' => $request->payment_method,
            'shipping_method_id' => $request->shipping_method,
            'order_status_id' => $this->order->status()->where('code','pending')->first()->id ?? null,
        ]);

        // Insert into order_product table
        foreach (Cart::content() as $item) {
            $this->handle_checkout->updateProductQuantity($item->model->id,  $item->qty);
            $this->order_product->create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        $order = $this->order->find($order->id);
        return $order;
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

    public function placeOrder(CheckoutRequest $request)
    {
        if($request->session()->has('bill')){
            $request->session()->forget('bill');
        }

        $order = $this->addToOrdersTables($request);

//        $this->sendOrderEmailAction($order);

        Cart::destroy();

        return redirect()->route('checkout.success')
            ->with([
                'bill' => $order,
            ]);
    }

    public function checkoutSuccess(Request $request)
    {
        $success = 'Đơn hàng của của quý khách đã được gửi đến chúng tôi. Xin cảm ơn quý khách!';
        if(Session::has('bill')){
            $bill = $request->session()->get('bill');
            $order_products = $bill->products;
            return view('frontend/content/checkout/checkout-success', compact('bill','order_products', 'success'));
        }else{
            return redirect()->route('cart.index');
        }
    }

    public function sendOrderEmailAction($order)
    {
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
            'payment_method' => $order->payment_methods,
            'created_at' => $order->created_at,
            'ordered_products' => $order->products,
            'customer' => auth()->user() ? auth()->user()->name : $order->billing_name,
            'products' => $order->products,
            'status' => $order->statuses->text,
            'payment_methods' => $order->payment_methods
        ];

        Mail::to($details['billing_email'])->send(new \App\Mail\SendOrderConfirmation($details));
    }
}
