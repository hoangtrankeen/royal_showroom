<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'id';

    public function products()
    {
        return $this->belongsToMany('App\Model\Product');
    }

    public function childs(){
        return $this->hasMany(self::class,'parent_id','id');
    }
    public function parent(){
        return $this->belongsTo(self::class,'parent_id','id');
    }

    public function getParentCategories()
    {
        return Category::where('parent_id',1)->get();
    }

}
