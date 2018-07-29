<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'sku','slug','price','sale_price','quantity','details',
        'description','featured','active','in_stock','images','sort_order',
        'type_id','child_id','parent_id'];

    protected $type_id = [
        'simple',
        'group'
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Model\Category');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Model\Group');
    }

    public function attributeValue()
    {
        return $this->belongsToMany('App\Model\AttributeValue', 'product_attribute', 'product_id', 'attribute_value_id')->withPivot('active');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Model\Order');
    }

    public function scopeMightAlsoLike($query)
    {
        return $query->inRandomOrder()->take(4);
    }

    public static function getSimpleProduct()
    {
        return Product::where('type_id', 'simple')->get();
    }

    public static function getGroupProduct()
    {
        return Product::where('type_id', 'group')->get();
    }

    public function getActiveProduct($paginate)
    {
        $product =  Product::where('active',true)
            ->orderBy('order')
            ->paginate($paginate);
        return $product;
    }

    public function getAllProduct()
    {
        return Product::all();
    }

    public static function getFinalPrice($product)
    {
        return $product->price;
    }
}
