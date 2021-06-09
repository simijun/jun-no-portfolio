<header class="mb-4">
    <div class='fixed-top'>
    <nav class="navbar navbar-expand-sm navbar-light bg-light justify-content-between">
        @if (Auth::check())
            <div class="flex-grow-1">
                <a class="navbar-brand" href="#">おすすめのYouTube動画</a>
            </div>
            <div class="flex-grow-1">
                {!! Form::open(['route' => 'posts.search', 'method' => 'get']) !!}
                    <div class="input-group mb-3">
                        {!! Form::text('keyword', null, ['class' => 'form-control', 'placeholder' => '検索']) !!}
                        <div class="input-group-append">
                            {!! Form::button('<i class="fas fa-search"></i>', ['class' => "btn form-inline", 'type' => 'submit']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            {{-- flex-grow-0 でnav-itemの要素幅を調整 --}}
            <div class="collapse navbar-collapse  navbarTogglerDemo02 flex-grow-2" id="">
                    <ul class="navbar-nav mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">ホーム<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            {!! link_to_route('posts.create', '新規投稿', [], ['class' => 'nav-link']) !!}
                        </li>
                        <li class="nav-item">
                            {!! link_to_route('posts.myposts', '投稿一覧', ['id' => Auth::id()], ['class' => 'nav-link']) !!}
                        </li>
    
                <div class="dropdown">
                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                        More
                    </button>
                    <div class="dropdown-menu">
                        <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト', [], ['class' => 'nav-link']) !!}</li>
                        <li class="dropdown-item">{!! link_to_route('users.delete_confirm', '退会', [], ['class' => 'nav-link']) !!}</li>
                    </div>
                </div>
            </div>
        @else
            <ul class="navbar-nav">
                {{-- ユーザ登録ページへのリンク --}}
                <li class="nav-item">{!! link_to_route('signup.get', 'ユーザ登録',  [], ['class' => 'nav-link']) !!}</li>
                {{-- ログインページへのリンク --}}
                <li class="nav-item">{!! link_to_route('login', 'ログイン',  [], ['class' => 'nav-link']) !!}</li>
            </ul>
        @endif
    </nav>
    </div>
</header>