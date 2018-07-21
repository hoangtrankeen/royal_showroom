<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'billing_email', 'billing_name', 'billing_address', 'billing_city',
        'billing_province', 'billing_postalcode', 'billing_phone', 'billing_name_on_card', 'billing_discount',
        'billing_discount_code', 'billing_subtotal', 'billing_tax', 'billing_total','delivery_date', 'error','payment_method', 'status',
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
