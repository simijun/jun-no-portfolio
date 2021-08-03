<div class="d-flex justify-content-center">
    {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
    <img class="mr-2 rounded" src="{{ Gravatar::get($user->email, ['size' => 40]) }}" alt="">
    {{-- ユーザー名表示 --}}
    <h3>{{ $user->name }}</h3>
    @include('user_follow.follow_button')
</div>