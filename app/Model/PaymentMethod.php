<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'id','description','detail'];
    public function order()
    {
        return $this->hasMany('App\Model\Order');
    }

}
