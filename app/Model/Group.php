<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $primaryKey = 'id';

    public function products()
    {
        return $this->belongsToMany('App\Model\Product');
    }
}
