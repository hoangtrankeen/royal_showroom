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
        $shipping_method = $this->shipping_method->getAvailableShippingMethod()->first();

        if (!($payment_methods && $shipping_method)) {
            return "Payment method and shipping method does not exist";
        }
        return view('frontend/content/checkout/checkout', compact('payment_methods', 'shipping_method'));
    }

    protected function addToOrdersTables($request)
    {
        // Insert into orders table
        $last_order_id = $this->order->getLastestOrder() ? $this->order->getLastestOrder()->id : 0;
        $order = $this->order->create([
            'id' => 100000 + $last_order_id,
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_name' => $request->billing_name,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone,
            'customer_message' => $request->customer_message,
            'subtotal' => $this->getNumbers()->get('newSubtotal'),
            'tax' => $this->getNumbers()->get('newTax'),
            'total' => $this->getNumbers()->get('newTotal'),

            'payment_method_id' => $this->payment_method->getDefaultPaymentMethod(),
            'shipping_method_id' => $this->shipping_method->getDefaultShippingMethod(),
            'order_status_id' => $this->order_status->getDefaultOrderStatus(),
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
        $this->sendOrderEmailAction($order);
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
        Mail::to($order->email)->send(new \App\Mail\SendOrderConfirmation($order));
    }
}
