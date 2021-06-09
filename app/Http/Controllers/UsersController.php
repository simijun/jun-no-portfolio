<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function show($id)
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // idの値でユーザを検索して取得
            $user = User::findOrFail($id);
            // ユーザの投稿の一覧を作成日時の降順で取得
            $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'posts' => $posts,
            ];
        } 
        return view('users.show', $data);
    }
    
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/');
    }

    public function delete_confirm()
    {
        return view('users.delete_confirm');
    }
}
