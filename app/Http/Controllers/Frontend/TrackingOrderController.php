<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Order;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrackingOrderController extends Controller
{
    public function index()
    {
        return view('frontend/order/tracking_form');
    }

    public function getOrderInformation(Request $request)
    {
        $id = $request->order_id;

        $order = Order::find($id);

        $products = $order->products;

        foreach($products  as $product)
        {
            $product->final_price = Product::getFinalPrice($product);
        }

        $data['products'] = $products;

        $data['order'] = $order;

        return view('frontend/order/tracking_info',$data);
    }
}
