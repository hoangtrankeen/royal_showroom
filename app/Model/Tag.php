<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public function posts()
    {
        return $this->belongsToMany('App\Post','post_tag','tag_id','post_id');
    }
}
