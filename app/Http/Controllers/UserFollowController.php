<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    //followアクション
    public function store($id)
    {
        \Auth::user()->follow($id);
        return back();
    }
    
    //unfollowアクション
    public function destroy($id)
    {
        \Auth::user()->unfollow($id);
        return back();
    }
}
