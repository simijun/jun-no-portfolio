@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-center">
        {{-- ログイン中ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
        <img class="mr-2 rounded" src="{{ Gravatar::get(Auth::user()->email, ['size' => 40]) }}" alt="">
        <h3>{{ $user->name }}さんの投稿一覧</h3>
    </div>

   {{-- 自分の投稿内容を新しい順に表示 --}}
   @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="card-body">
                <div class="border-bottom">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            {{-- 動画タイトルをYouTubeへのリンクにする --}}
                            <p class="mt-2"><a href="https://youtu.be/{{ $post->video_id }}">{{ $post->title }}</a></p>
                            <div class="row">
                                <div class="youtube_area col-12 col-lg-5">
                                    {{-- iframeタグで動画プレイヤーを埋め込む --}}
                                    <iframe id="ytplayer" type="text/html" width="480" height="270"
                                    src="https://www.youtube.com/embed/{{ $post->video_id }}"
                                    frameborder="0"></iframe> 
                                </div> 
                                <div class="col-12 offset-lg-1 col-lg-6">
                                    <p class="mt-2">{!! nl2br(e($post->content)) !!}</p>
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
                                    @if (Auth::check())
                                        <div class="d-flex flex-row">
                                            {{-- 投稿編集ページへのリンク --}}
                                            {!! link_to_route('posts.edit', '編集', [$post->id], ['class' => 'btn btn-primary btn-sm'], ) !!}
                                            {{-- 投稿削除ボタンのフォーム --}}
                                            {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                                                {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        @endforeach
        {{-- ページネーションのリンク --}}
        {{ $posts->links() }}
    @endif
    
@endsection

