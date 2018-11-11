<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_status';

    protected $primaryKey = 'id';

    protected $fillable = ['name','code','description','details','active'];

    protected $default_order_status_code = 'pending';

    public function orders()
    {
        return $this->hasMany('App\Model\Order');
    }

    public function getDefaultOrderStatus()
    {   

        return OrderStatus::where('code', 'pending') ? 
        OrderStatus::where('code', 'pending')->first()->id : 'Order status not exist';
    }
}
