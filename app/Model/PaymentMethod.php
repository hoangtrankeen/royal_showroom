<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';

    protected $primaryKey = 'id';

    protected $fillable = ['name','code','description','detail','image','active'];

    public function orders()
    {
        return $this->hasMany('App\Model\Order');
    }

    public function getAvailablePaymentMethod()
    {
        return PaymentMethod::where('active', 1)->get();
    }

}
