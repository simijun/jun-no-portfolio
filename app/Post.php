<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Post extends Model
{
    protected $fillable = ['video_id', 'title', 'content', 'rating'];
    
    //この投稿を所有するユーザ。（Userモデルとの関係を定義）
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    
}
