<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attributes';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'type','inform_name','active'];

    public function attributeValue()
    {
        return $this->hasMany('App\Model\AttributeValue','attribute_id', 'id');
    }

    public function availableAttributeType()
    {
        return [
          'select',
          'text'
        ];
    }

}
