<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    protected $table = 'shipping_methods';

    protected $primaryKey = 'id';

    protected $fillable = ['name','code','price','description','details','active'];

    public function order()
    {
        return $this->hasMany('App\Model\Order');
    }

    public function getAvailableShippingMethod()
    {
        return ShippingMethod::where('active', 1)->get();
    }
}
