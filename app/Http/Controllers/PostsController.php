<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    //welcomeビューの下段で新着動画を表示
    public function index()
    {
        
        $data = [];
        if (\Auth::check()) {
            //認証済みの場合ユーザを取得
            $user = \Auth::user();

            // 所有者関係なく、全ユーザのPostから取得して作成日時の降順で取得
            $posts = Post::orderBy('created_at', 'desc')->get();
            $data = [
                'user' => $user,
                'posts' => $posts,
            ];
        }

        // Welcomeビューでそれらを表示
        return view('welcome', $data);
    }
    
    //検索
    public function search(Request $request) {
        $keyword = $request->input('keyword');
        $rating = $request->input('rating');
        
        //クエリビルダー取得
        $query = Post::query();
        
        //キーワードで検索
        if (!empty($keyword)) {
            $query->where(function($query) use($keyword) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('content', 'LIKE', "%{$keyword}%")
                ->orWhere('rating', 'LIKE', "%{$keyword}%");
            });
        }
        //☆の数で検索
        if (!empty($rating)) {
            $query->where('rating', '>=', $rating);
        }
        
        //投稿を1ページにつき10個表示させる
        $posts = $query->paginate(10);
        
        //search.blade.phpでそれらを表示
        return view('posts.search', ['posts' => $posts]);
        
    }
    
    public function myposts()
    {
         $data = [];
        
            $user = \Auth::user();

            // ユーザの投稿の一覧を作成日時の降順で取得
            $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'posts' => $posts,
            ];

        // posts.blade.phpでそれらを表示
        return view('posts.posts', $data);
    }
    
    
    public function create()
    {
        $post = new Post;

        // 新規投稿ビューを表示
        return view('posts.create', [
            'post' => $post,
        ]);
    }
    
    // 投稿登録処理
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required',
            'content' => 'required|max:255',
            'video_id' => 'required',
            'video_id' => 'url',
            'rating' => 'required',
        ]);
        
        // 新規投稿を作成
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->video_id = $request->video_id;
        $post->rating = $request->rating;
        $post->user_id = \Auth::id();
        $post->save();
        
        //第一引数に正規表現、第二引数に検索対象となる文字列、第三引数に検索結果を返す
        $mystring = $post->video_id;
        $findme = 'youtu.be/';
        $pos = strpos($mystring, $findme);
        
        if ($pos === false) {
            //WebでYouTubeを開いた時のURLを取得(非短縮系)
            preg_match('/\?v=([a-zA-Z0-9]+)/',$post->video_id,$match);
            
        }
        else {
            //共有ボタンでリンクコピペする際の短縮形URL取得(youtu.be/ 以下の半角英数字を取得する正規表現)
            preg_match('/\/youtu\.be\/([a-zA-Z0-9]+)/',$post->video_id,$match);    
        }
        
        
        $post->video_id = $match[1];
        $post->save();
        

        // トップページへリダイレクトさせる
        return redirect('/');
    }
    
    
     public function edit($id)
    {
        // idの値で投稿を検索して取得
        $post = Post::findOrFail($id);

        // 投稿編集ビューでそれを表示
        return view('posts.edit', [
            'post' => $post,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'title' => 'required',
            'content' => 'required|max:255',
            'video_id' => 'required',
            'video_id' => 'url',
            'rating' => 'required',
        ]);
        
        // idの値で投稿を検索して取得
        $post = Post::findOrFail($id);
        // メッセージを更新
        $post->video_id = $request->video_id;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->rating = $request->rating;
        $post->save();
        
        //第一引数に正規表現、第二引数に検索対象となる文字列、第三引数に検索結果を返す
        $mystring = $post->video_id;
        $findme = 'youtu.be/';
        $pos = strpos($mystring, $findme);
        
        if ($pos === false) {
            //WebでYouTubeを開いた時のURLを取得(非短縮系)
            preg_match('/\?v=([a-zA-Z0-9]+)/',$post->video_id,$match);
            
        }
        else {
            //共有ボタンでコピペしたときの短縮形URL取得(youtu.be/ 以下の半角英数字を取得する正規表現)
            preg_match('/\/youtu\.be\/([a-zA-Z0-9]+)/',$post->video_id,$match);    
        }
        
        
        
        $post->video_id = $match[1];
        $post->save();
        
        
        // トップページへリダイレクトさせる
        return redirect('/');
    }

    
    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $post = \App\Post::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if (\Auth::id() === $post->user_id) {
            $post->delete();
        }

        // トップページへリダイレクトさせる
        return back();
    }
    
    
}
