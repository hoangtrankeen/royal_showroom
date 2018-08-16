<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CommentSpam extends Model
{
    protected $fillable = ['comment_id', 'user_id'];

    protected $table = 'comment_spam';

    public $timestamps = false;


}
