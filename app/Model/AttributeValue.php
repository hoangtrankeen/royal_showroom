<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $table = 'attribute_value';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'attribute_id', 'name', 'created_at', 'updated_at'];

    protected $guarded = [];

    public function attribute()
    {
        return $this->belongsTo('App\Model\Attribute');
    }

    public function product()
    {
        return $this->belongsToMany('App\Model\Product','product_attribute','attribute_value_id','product_id');
    }




}
