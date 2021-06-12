@extends('layouts.app')

@section('content')

    @if (Auth::check())
        <div class="text-center">
            {{-- ログイン済みの時の表示（一覧表示） --}}
            {{ Auth::user()->name}}さんがログイン中
        </div>
            
        <div class="card">
            @if (Auth::check())
                <div class="card-header">
                    新着動画
                </div>
                @if (count($posts) > 0)
                    @foreach ($posts as $post)
                   
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <p>動画タイトル：<a href="https://youtu.be/{{ $post->video_id }}">{{ $post->title }}</a></p>
                                    <div class="row">
                                        <div class="youtube_area col-12 col-lg-5">
                                            {{-- iframeタグで動画プレイヤーを埋め込む --}}
                                            <iframe id="ytplayer" type="text/html" width="480" height="270"
                                            src="https://www.youtube.com/embed/{{ $post->video_id }}"
                                            frameborder="0"></iframe> 
                                        </div> 
                                        <div class="col-12 offset-lg-1 col-lg-6">
                                            {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                                            <img class="mr-2 rounded" src="{{ Gravatar::get($post->user->email, ['size' => 30]) }}" alt="">
                                            {{-- 投稿ユーザーの投稿一覧ページへのリンク --}}
                                            {!! link_to_route('users.show', $post->user->name, ['user' => $post->user->id], ) !!}
                                            
                                            <p>{!! nl2br(e($post->content)) !!}</p>
                                            <p>おすすめ度
                                                <span class="rating rating-show">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $post->rating) 
                                                            <span class="star_yellow">★</span>
                                                        @else 
                                                            <span class="star_gray">★</span>
                                                        @endif
                                                    @endfor
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                @endif
            @endif
        </div>
    @else
        {{-- 未ログインの時の表示（welcomeページ） --}}
        <div class="text-center">    
            <h1>おすすめのYouTube動画</h1>
            {{-- ユーザ登録ページへのリンク --}}
            {!! link_to_route('signup.get', 'ユーザ登録', [], ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    @endif
    



@endsection