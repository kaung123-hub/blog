<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\BlogPost;

use App\User;

class Comment extends Model
{
    protected $fillable = ['blog_post_id','content','user_id'];

    public function post(){
        return $this->belongsTo(BlogPost::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
