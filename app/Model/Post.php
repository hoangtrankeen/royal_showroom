<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $primaryKey = 'id';

    protected $fillable = ['title','description','slug','image','post_content','meta_title','meta_desc','meta_keyword','featured','active'];

    protected $guarded = [];

    public function topics()
    {
        return $this->belongsToMany('App\Model\Topic','post_topic','post_id','topic_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Model\Tag','post_tag','post_id','tag_id');
    }

    public $photo_path = 'media/posts';
}
