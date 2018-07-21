<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_statuses';

    protected $primaryKey = 'id';

    protected $fillable = ['id','name'];

    public function order()
    {
        return $this->hasMany('App\Model\Order');
    }
}
