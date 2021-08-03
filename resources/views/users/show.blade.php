@extends('layouts.app')

@section('content')
    {{-- ユーザ情報 --}}
    @include('users.card')
    <div class="d-flex justify-content-center">
        <div class="col-sm">
            {{-- タブ --}}
            @include('users.navtabs')
            {{-- ユーザーの投稿内容を新しい順に表示 --}}        
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
        </div>
    </div>
@endsection

    
