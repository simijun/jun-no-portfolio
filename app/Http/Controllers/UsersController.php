<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    
    public function index()
    {
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    //ユーザ詳細からそのユーザの投稿を取得
    public function show($id)
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // idの値でユーザを検索して取得
            $user = User::findOrFail($id);
            // ユーザの投稿の一覧を作成日時の降順で取得
            $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);
            $user->loadRelationshipCounts();

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
    
    //フォロー一覧
    public function followings($id)
    {
        $user = User::findOrFail($id);
        $user->loadRelationshipCounts();
        //ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);
        
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
            ]);
    }
    
    //フォロワー一覧
    public function followers($id)
    {
        $user = User::findOrFail($id);
        $user->loadRelationshipCounts();
        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->paginate(10);

        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
}
