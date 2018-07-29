<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_statuses';

    protected $primaryKey = 'id';

    protected $fillable = ['name','code','description','details','active'];

    public function order()
    {
        return $this->hasMany('App\Model\Order');
    }
}
