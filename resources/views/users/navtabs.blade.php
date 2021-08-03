<ul class="nav nav-tabs nav-justified mb-3">
    {{-- ユーザの投稿一覧、フォロー/アンフォローのタブ --}}
    <li class="nav-item">
        <a href="{{ route('users.show', ['user' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.show') ? 'active' : '' }}">
            投稿
            <span class="badge badge-secondary">{{ $user->posts_count }}</span>
        </a>
    </li>
    {{-- フォロー中タブ --}}           
    <li class="nav-item">
        <a href="{{ route('users.followings', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.followings') ? 'active' : '' }}">
            フォロー中
            <span class="badge badge-secondary">{{ $user->followings_count }}</span>
        </a>
    </li>
    {{-- フォロワータブ --}}
    <li class="nav-item">
        <a href="{{ route('users.followers', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.followers') ? 'active' : '' }}">
            フォロワー
            <span class="badge badge-secondary">{{ $user->followers_count }}</span>
        </a>
    </li>
</ul>


