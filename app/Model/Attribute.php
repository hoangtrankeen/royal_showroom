<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attribute';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'type'];

    public function attributeValue()
    {
        return $this->hasMany('App\Model\AttributeValue','attribute_id', 'id');
    }

    public static function availableAttributeType()
    {
        return [
          'select',
          'text'
        ];
    }

}
