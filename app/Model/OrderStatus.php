<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_status';

    protected $primaryKey = 'id';

    protected $fillable = ['name','code','description','details','active'];

    public function orders()
    {
        return $this->hasMany('App\Model\Order');
    }

    public function getDefaultOrderStatus()
    {
        return OrderStatus::where('active', 1)->first()->id;
    }
}
