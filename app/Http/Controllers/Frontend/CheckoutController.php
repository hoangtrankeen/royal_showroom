<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\HandleCheckoutController;
use App\Http\Middleware\CartMiddleware;
use App\Model\Order;
use App\Model\OrderProduct;
use App\Model\PaymentMethod;
use App\Model\OrderStatus;
//use App\Mail\OrderPlaced;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    protected $handle_checkout;

    public function __construct(HandleCheckoutController $handle_checkout)
    {
            $this->handle_checkout = $handle_checkout;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = PaymentMethod::all();
        return view('frontend/content/checkout/checkout')->with('payments', $payments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CheckoutRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        $contents = Cart::content()->map(function ($item) {
            return $item->model->slug.', '.$item->qty;
        })->values()->toJson();

        try {
            $charge = Stripe::charges()->create([

                'amount' => $this->getNumbers()->get('newTotal'),
                'currency' => 'VND',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                    'discount' => collect(session()->get('coupon'))->toJson(),
                ],
            ]);

            $order = $this->addToOrdersTables($request, null);
//            Mail::send(new OrderPlaced($order));

            Cart::instance('default')->destroy();
            session()->forget('coupon');
            return redirect()->back();
//            return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
        } catch (CardErrorException $e) {
            $this->addToOrdersTables($request, $e->getMessage());
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    protected function addToOrdersTables($request, $error)
    {

        $delivery_date =  date('Y-m-d', strtotime($request->delivery_date));
        // Insert into orders table
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
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
            'error' => $error,
        ]);


        // Insert into order_product table
        foreach (Cart::content() as $item) {

            $this->handle_checkout->updateProductQuantity($item->model->id,  $item->qty);

            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        $order = Order::find($order->id);

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

        $order = $this->addToOrdersTables($request, null);

        $this->sendOrderEmailAction($order);

        Cart::destroy();

        return redirect()->route('checkout.success')
            ->with([
                'bill' => $order,

            ]);

    }

    public function checkoutSuccess(Request $request)
    {
        $success = 'Đơn hàng của bạn đã được gửi đến chúng tôi. Xin cảm ơn!';
        if(Session::has('bill')){
            $bill = $request->session()->get('bill');
            $order_products = $bill->products;
            return view('frontend/checkout-success')->with('bill',$bill)->with('order_products', $order_products)->with('success', $success);
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
