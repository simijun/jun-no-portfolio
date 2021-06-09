@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-center">
        {{-- ログイン中ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
        <img class="mr-2 rounded" src="{{ Gravatar::get(Auth::user()->email, ['size' => 30]) }}" alt="">
        {{ $user->name }}さんの投稿一覧
    </div>

    

   {{-- 自分の投稿内容を新しい順に表示 --}}
   @if (count($posts) > 0)
        @foreach ($posts as $post)
            @if (count($posts) > 0)
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
                                    
                                    <p>コメント：{{ $post->content }}</p>
                                    <p>おすすめ度：
                                        <span class="rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i >= $post->rating) 
                                                    <span class="star_yellow">★</span>
                                                @else 
                                                    <span class="star_gray">★</span>
                                                @endif
                                            @endfor
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </ul>
                    </li>
                </div>
            @endif
            {!! Form::close() !!}
        @endforeach
        {{-- ページネーションのリンク --}}
        {{ $posts->links() }}
    @endif
    
@endsection

