<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
        
        
    ];
    
    //モデル側で論理削除をできるようにする(退会処理)
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //このユーザが所有する投稿(Postsモデルとの関係を定義)
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    //このユーザがフォロー中のユーザ（ Userモデルとの関係を定義）
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
    //このユーザをフォロー中のユーザ（ Userモデルとの関係を定義）
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    //$userIDで指定されたユーザをフォローする
    public function follow($userId)
    {
        //フォロー済みかどうか
        $exist = $this->is_following($userId);
        //自分自身かどうか
        $its_me = $this->id == $userId;
        
        if ($exist || $its_me) {
            return false;
        }
        else {
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    //$userIdで指定されたユーザのフォローを外す
    public function unfollow($userId)
    {
        //フォロー済みかどうか
        $exist = $this->is_following($userId);
        //自分自身かどうか
        $its_me = $this->id == $userId;
            
        if ($exist && !$its_me) {
            $this->followings()->detach($userId);
            return true;
        }
        else {
            return false;
        }
    }
    
    //フォロー中のユーザの中に$userIdのものが存在するかどうか
    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }

    //このユーザに関係するモデルの件数をロード
    public function loadRelationshipCounts()
    {
        $this->loadCount('posts', 'followings', 'followers');
    }
    
    //リレーション先のPostも論理削除する
    public static function boot()
    {
        parent::boot();

        static::deleted(function ($user) {
            $user->posts()->delete();
        });
    }
}
