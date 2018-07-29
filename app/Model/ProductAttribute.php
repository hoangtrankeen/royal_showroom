<?php
/**
 * Created by PhpStorm.
 * User: HDN
 * Date: 4/19/2018
 * Time: 7:44 AM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $table= 'product_attribute';

    protected $fillable = ['product_id', 'attribute_value_id', 'active'];

}