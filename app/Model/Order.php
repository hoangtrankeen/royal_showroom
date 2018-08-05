<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'email', 'name', 'address', 'city',
        'province', 'postalcode', 'phone',
        'discount','discount_code',
        'subtotal', 'tax', 'total',
        'delivery_date','payment_method', 'shipping_method', 'status',
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

    public function statuses()
    {
        return $this->belongsTo('App\Model\OrderStatus', 'status');
    }

    public function payment_methods()
    {
        return $this->belongsTo('App\Model\PaymentMethod', 'payment_method');
    }

}
