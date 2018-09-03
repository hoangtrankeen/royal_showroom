<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'id','user_id', 'email', 'billing_name', 'address', 'city',
        'province', 'postalcode', 'phone',
        'discount','discount_code',
        'subtotal', 'tax', 'total',
        'delivery_date','payment_method_id', 'shipping_method_id', 'order_status_id',
        'card_name','card_number','customer_paid','customer_message','order_description'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Model\User','user_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Model\Product')->withPivot('quantity');
    }

    public function status()
    {
        return $this->belongsTo('App\Model\OrderStatus','order_status_id');
    }

    public function payment_method()
    {
        return $this->belongsTo('App\Model\PaymentMethod','payment_method_id');
    }

    public function shipping_method()
    {
        return $this->belongsTo('App\Model\PaymentMethod');
    }

    public function getLastestOrder()
    {
        return DB::table('orders')->latest()->first();
    }

}
